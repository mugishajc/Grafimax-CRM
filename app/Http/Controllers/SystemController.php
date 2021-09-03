<?php

namespace App\Http\Controllers;

use App\Utility;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('manage system settings'))
        {
            $settings = Utility::settings();

            return view('settings.index', compact('settings'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('manage system settings'))
        {
            \Cache::forget('settings');

            if(!isset($request->header_text) && empty($request->header_text))
            {
                $header_text = '';
            }
            else
            {
                $header_text = $request->header_text;
            }

            if(!isset($request->footer_text) && empty($request->footer_text))
            {
                $footer_text = '';
            }
            else
            {
                $footer_text = $request->footer_text;
            }


            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                             $header_text,
                                                                                                                                             'header_text',
                                                                                                                                             \Auth::user()->creatorId(),
                                                                                                                                         ]
            );
            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                             $footer_text,
                                                                                                                                             'footer_text',
                                                                                                                                             \Auth::user()->creatorId(),
                                                                                                                                         ]
            );

            if($request->favicon)
            {
                $request->validate(['favicon' => 'required|image|mimes:png|max:1024',]);
                $faviconName = 'favicon.png';
                $path        = $request->file('favicon')->storeAs('public/logo/', $faviconName);
            }
            if($request->small_logo)
            {
                $request->validate(['small_logo' => 'required|image|mimes:png|max:1024',]);
                $smallName = 'small-logo.png';
                $path      = $request->file('small_logo')->storeAs('public/logo/', $smallName);
            }
            if($request->logo)
            {
                $request->validate(['logo' => 'required|image|mimes:png|max:1024',]);
                $logoName = 'logo.png';
                $path     = $request->file('logo')->storeAs('public/logo/', $logoName);
            }

            return redirect()->back()->with('success', 'Site Setting successfully updated.');
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveEmailSettings(Request $request)
    {
        if(\Auth::user()->can('manage system settings'))
        {
            \Cache::forget('settings');

            $request->validate(
                [
                    'mail_driver' => 'required|string|max:50',
                    'mail_host' => 'required|string|max:50',
                    'mail_port' => 'required|string|max:50',
                    'mail_username' => 'required|string|max:50',
                    'mail_password' => 'required|string|max:50',
                    'mail_encryption' => 'required|string|max:50',
                    'mail_from_address' => 'required|string|max:50',
                    'mail_from_name' => 'required|string|max:50',
                ]
            );

            $arrEnv = [
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
            ];

            $env = Utility::setEnvironmentValue($arrEnv);

            if($env)
            {
                return redirect()->back()->with('success', __('Setting successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveCompanySettings(Request $request)
    {
        if(\Auth::user()->can('manage company settings'))
        {
            \Cache::forget('settings');

            $user = \Auth::user();
            $request->validate(
                [
                    'company_name' => 'required|string|max:50',
                    'company_email' => 'required',
                    'company_email_from_name' => 'required|string',
                ]
            );
            $post = $request->all();
            unset($post['_token']);

            foreach($post as $key => $data)
            {
                \DB::insert(
                    'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                                 $data,
                                                                                                                                                 $key,
                                                                                                                                                 \Auth::user()->creatorId(),
                                                                                                                                             ]
                );
            }

            return redirect()->back()->with('success', __('Setting successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveStripeSettings(Request $request)
    {
        if(\Auth::user()->can('manage stripe settings'))
        {
            \Cache::forget('settings');

            $user = \Auth::user();

            $request->validate(
                [
                    'stripe_key' => 'required|string|max:50',
                    'stripe_secret' => 'required|string|max:50',
                ]
            );

            $arrEnvStripe = [
                'STRIPE_KEY' => $request->stripe_key,
                'STRIPE_SECRET' => $request->stripe_secret,
            ];

            $envStripe = Utility::setEnvironmentValue($arrEnvStripe);

            if($envStripe)
            {
                return redirect()->back()->with('success', __('Stripe successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', 'Something went wrong.');
            }
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveSystemSettings(Request $request)
    {
        if(\Auth::user()->can('manage company settings'))
        {
            \Cache::forget('settings');

            $user = \Auth::user();
            $request->validate(
                [
                    'site_currency' => 'required',
                ]
            );
            $post = $request->all();
            unset($post['_token']);

            foreach($post as $key => $data)
            {
                \DB::insert(
                    'insert into settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                                                                                                                                                                                 $data,
                                                                                                                                                                                 $key,
                                                                                                                                                                                 \Auth::user()->creatorId(),
                                                                                                                                                                                 date('Y-m-d H:i:s'),
                                                                                                                                                                                 date('Y-m-d H:i:s'),
                                                                                                                                                                             ]
                );
            }

            return redirect()->back()->with('success', __('Setting successfully updated.'));

        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function companyIndex()
    {
        if(\Auth::user()->can('manage company settings'))
        {
            $settings = Utility::settings();

            return view('settings.company', compact('settings'));
        }
        else
        {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }
}
