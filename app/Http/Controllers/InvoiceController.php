<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Invoice;
use App\InvoicePayment;
use App\InvoiceProduct;
use App\Invoicr;
use App\Milestone;
use App\Payment;
use App\Products;
use App\Task;
use App\Tax;
use App\User;
use App\Utility;
use Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        if(\Auth::user()->can('manage invoice') || \Auth::user()->type == 'client')
        {
            if(\Auth::user()->type == 'client')
            {
                $invoices = Invoice::select(['invoices.*'])->join('projects', 'projects.id', '=', 'invoices.project_id')->where('projects.client', '=', \Auth::user()->id)->where('invoices.created_by', '=', \Auth::user()->creatorId())->get();
            }
            else
            {
                $invoices = Invoice::where('created_by', '=', \Auth::user()->creatorId())->get();
            }

            return view('invoices.index')->with('invoices', $invoices);
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    public function create()
    {
        if(\Auth::user()->can('create invoice'))
        {
            $taxes    = Tax::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
            $projects = \Auth::user()->projects->pluck('name', 'id');

            $taxes->prepend('Select Tax', '');
            $projects->prepend('Select Project', '');

            return view('invoices.create', compact('projects', 'taxes'));
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function store(Request $request)
    {
        if(\Auth::user()->can('create invoice'))
        {
            $validator = \Validator::make(
                $request->all(), [
                                   // 'project_id' => 'required',
                                   'issue_date' => 'required',
                                   'due_date' => 'required',
                               ]
            );

            if($validator->fails())
            {
                $messages = $validator->getMessageBag();

                return redirect()->route('invoices.index')->with('error', $messages->first());
            }

            $invoice             = new Invoice();
            $invoice->invoice_id = $this->invoiceNumber();
            $invoice->status     = 0;
            $invoice->issue_date = $request->issue_date;
            $invoice->due_date   = $request->due_date;
            $invoice->discount   = 0;
            $invoice->terms      = $request->terms;

            if(isset($request->project_id) && !empty($request->project_id))
            {
                $invoice->project_id = $request->project_id;
            }
            if(isset($request->tax_id) && !empty($request->tax_id))
            {
                $invoice->tax_id = $request->tax_id;
            }
            $invoice->created_by = \Auth::user()->creatorId();
            $invoice->save();

            ActivityLog::create(
                [
                    'user_id' => \Auth::user()->creatorId(),
                    'project_id' => (isset($request->project_id) && !empty($request->project_id)) ? $request->project_id : 0,
                    'log_type' => 'Create Invoice',
                    'remark' => sprintf(__('%s Create new invoice "%s"'), \Auth::user()->name, \Auth::user()->invoiceNumberFormat($invoice->invoice_id)),
                ]
            );

            return redirect()->route('invoices.show', $invoice->id)->with('success', __('Invoice successfully created.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    function invoiceNumber()
    {
        $latest = Invoice::where('created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if(!$latest)
        {
            return 1;
        }

        return $latest->invoice_id + 1;
    }

    public function show(Invoice $invoice)
    {
        if(\Auth::user()->can('show invoice') || \Auth::user()->type == 'client')
        {
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $settings = Utility::settings();
                if(!empty($invoice->project))
                {
                    $client = $invoice->project->client;
                    if($client != 0)
                    {
                        $user = User::where('id', $client)->first();
                    }
                    else
                    {
                        $user = '';
                    }
                }
                else
                {
                    $user = '';
                }

                return view('invoices.view', compact('invoice', 'settings', 'user'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function edit(Invoice $invoice)
    {
        if(\Auth::user()->can('edit invoice'))
        {
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $taxes    = Tax::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $projects = \Auth::user()->projects->pluck('name', 'id');

                $taxes->prepend('Select Tax', '');
                $projects->prepend('Select Project', '');

                return view('invoices.edit', compact('invoice', 'projects', 'taxes'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function update(Request $request, Invoice $invoice)
    {
        if(\Auth::user()->can('edit invoice'))
        {

            if($invoice->created_by == \Auth::user()->creatorId())
            {

                $validator = \Validator::make(
                    $request->all(), [
                                       'project_id' => 'required',
                                       'issue_date' => 'required',
                                       'due_date' => 'required',
                                       'discount' => 'required|min:0',
                                   ]
                );

                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('invoices.index')->with('error', $messages->first());
                }

                $invoice->project_id = $request->project_id;
                $invoice->issue_date = $request->issue_date;
                $invoice->due_date   = $request->due_date;
                $invoice->tax_id     = $request->tax_id;
                $invoice->terms      = $request->terms;
                $invoice->discount   = $request->discount;
                $invoice->save();

                return redirect()->back()->with('success', __('Invoice successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function destroy(Invoice $invoice)
    {
        if(\Auth::user()->can('delete invoice'))
        {
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $invoice->delete();
                InvoicePayment::where('invoice_id', '=', $invoice->id)->delete();
                InvoiceProduct::where('invoice_id', '=', $invoice->id)->delete();

                return redirect()->route('invoices.index')->with('success', __('Invoice successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function productAdd($id)
    {
        if(\Auth::user()->can('create invoice product'))
        {
            $invoice = Invoice::find($id);
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $products   = Products::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');
                $milestones = Milestone::where('project_id', $invoice->project_id)->get();
                $tasks      = Task::where('project_id', $invoice->project_id)->get();

                return view('invoices.product', compact('invoice', 'milestones', 'tasks'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function productStore($id, Request $request)
    {
        if(\Auth::user()->can('create invoice product'))
        {
            $invoice = Invoice::find($id);

            if($invoice->getTotal() == 0.0)
            {
                Invoice::change_status($invoice->id, 1);
            }

            if($invoice->created_by == \Auth::user()->creatorId())
            {
                if($request->type == 'milestone')
                {
                    $validator = \Validator::make(
                        $request->all(), [
                                           'milestone_id' => 'required',
                                       ]
                    );
                    if($validator->fails())
                    {
                        $messages = $validator->getMessageBag();

                        return redirect()->route('invoices.show', $invoice->id)->with('error', __('Please select milestone or task.'));

                    }

                    $task      = Task::find($request->task_id);
                    $milestone = Milestone::find($request->milestone_id);
                    $item      = (!empty($task->title) ? $task->title : '') . '-' . (!empty($milestone->title) ? $milestone->title : '');
                    $price     = $request->price;
                }
                else
                {
                    $validator = \Validator::make(
                        $request->all(), [
                                           'title' => 'required',
                                           'price' => 'required',
                                       ]
                    );
                    if($validator->fails())
                    {
                        $messages = $validator->getMessageBag();

                        return redirect()->route('invoices.show', $invoice->id)->with('error', __('title and price filed are required'));

                    }

                    $item  = $request->title;
                    $price = $request->price;
                }


                InvoiceProduct::create(
                    [
                        'invoice_id' => $invoice->id,
                        'iteam' => $item,
                        'price' => $price,
                        'type' => $request->type,
                    ]
                );

                if($invoice->getTotal() > 0.0 || $invoice->getDue() < 0.0)
                {
                    Invoice::change_status($invoice->id, 2);
                }

                return redirect()->route('invoices.show', $invoice->id)->with('success', __('Product successfully added.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function productEdit($id, $product_id)
    {
        if(\Auth::user()->can('edit invoice product'))
        {
            $invoice = Invoice::find($id);
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $product  = InvoiceProduct::find($product_id);
                $products = Products::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('invoices.product', compact('invoice', 'products', 'product'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function productUpdate($id, $product_id, Request $request)
    {
        if(\Auth::user()->can('edit invoice product'))
        {
            $invoice = Invoice::find($id);
            if($invoice->created_by == \Auth::user()->creatorId())
            {

                $validator = \Validator::make(
                    $request->all(), [
                                       'product_id' => 'required',
                                       'quantity' => 'required|numeric|min:1',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('invoices.show', $invoice->id)->with('error', $messages->first());
                }
                $product                     = Products::find($request->product_id);
                $invoiceProduct              = InvoiceProduct::find($product_id);
                $invoiceProduct->product_id  = $product->id;
                $invoiceProduct->price       = $product->price;
                $invoiceProduct->quantity    = $request->quantity;
                $invoiceProduct->description = $request->description;
                $invoiceProduct->save();

                return redirect()->route('invoices.show', $invoice->id)->with('success', __('Product successfully updated.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function productDelete($id, $product_id)
    {
        if(\Auth::user()->can('delete invoice product'))
        {
            $invoice = Invoice::find($id);
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $invoiceProduct = InvoiceProduct::find($product_id);
                $invoiceProduct->delete();
                if($invoice->getDue() <= 0.0)
                {
                    Invoice::change_status($invoice->id, 3);
                }

                return redirect()->route('invoices.show', $invoice->id)->with('success', __('Product successfully deleted.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function milestoneTask(Request $request)
    {
        if(!empty($request->milestone_id))
        {
            $tasks = Task::where('milestone_id', $request->milestone_id)->get();

            return $tasks;
        }
        else
        {
            $tasks = Task::where('project_id', $request->project_id)->get();

            return $tasks;
        }

    }

    public function paymentAdd($id)
    {
        if(\Auth::user()->can('create invoice payment'))
        {
            $invoice = Invoice::find($id);
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $payment_methods = Payment::where('created_by', '=', \Auth::user()->creatorId())->get()->pluck('name', 'id');

                return view('invoices.payment', compact('invoice', 'payment_methods'));
            }
            else
            {
                return response()->json(['error' => __('Permission denied.')], 401);
            }
        }
        else
        {
            return response()->json(['error' => __('Permission denied.')], 401);
        }
    }

    public function paymentStore($id, Request $request)
    {
        if(\Auth::user()->can('create invoice payment'))
        {
            $invoice = Invoice::find($id);
            if($invoice->created_by == \Auth::user()->creatorId())
            {
                $validator = \Validator::make(
                    $request->all(), [
                                       'amount' => 'required|numeric|min:1',
                                       'date' => 'required',
                                       'payment_id' => 'required',
                                   ]
                );
                if($validator->fails())
                {
                    $messages = $validator->getMessageBag();

                    return redirect()->route('invoices.show', $invoice->id)->with('error', $messages->first());
                }
                InvoicePayment::create(
                    [
                        'transaction_id' => $this->transactionNumber(),
                        'invoice_id' => $invoice->id,
                        'amount' => $request->amount,
                        'date' => $request->date,
                        'payment_id' => $request->payment_id,
                        'notes' => $request->notes,
                    ]
                );
                if($invoice->getDue() == 0.0)
                {
                    Invoice::change_status($invoice->id, 3);
                }
                else
                {
                    Invoice::change_status($invoice->id, 2);
                }

                return redirect()->route('invoices.show', $invoice->id)->with('success', __('Payment successfully added.'));
            }
            else
            {
                return redirect()->back()->with('error', __('Permission denied.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    function transactionNumber()
    {
        $latest = InvoicePayment::select('invoice_payments.*')->join('invoices', 'invoice_payments.invoice_id', '=', 'invoices.id')->where('invoices.created_by', '=', \Auth::user()->creatorId())->latest()->first();
        if($latest)
        {
            return $latest->transaction_id + 1;
        }

        return 1;
    }

    public function payments()
    {
        if(\Auth::user()->can('manage invoice payment') || \Auth::user()->type == 'client')
        {
            if(\Auth::user()->type == 'client')
            {
                $payments = InvoicePayment::select(['invoice_payments.*'])->join('invoices', 'invoice_payments.invoice_id', '=', 'invoices.id')->join('projects', 'invoices.project_id', '=', 'projects.id')->where('projects.client', '=', \Auth::user()->id)->where(
                    'invoices.created_by', '=', \Auth::user()->creatorId()
                )->get();
            }
            else
            {
                $payments = InvoicePayment::select(['invoice_payments.*'])->join('invoices', 'invoice_payments.invoice_id', '=', 'invoices.id')->where('invoices.created_by', '=', \Auth::user()->creatorId())->get();
            }

            return view('invoices.all-payments', compact('payments'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function printInvoice($id)
    {
        if(\Auth::user()->can('manage invoice'))
        {
            $invoice  = Invoice::findOrFail($id);
            $settings = Utility::settings();

            if(!empty($invoice->project))
            {
                $client = $invoice->project->client;
                if($client != 0)
                {
                    $user = User::where('id', $client)->first();
                }
                else
                {
                    $user = '';
                }
            }
            else
            {
                $user = '';
            }

            $invoicr = new Invoicr();
            $invoicr->invoicr("A4", $settings['site_currency_symbol'], "en");

            //Set number formatting
            $invoicr->setNumberFormat('.', ',');

            //Set your logo
            $img = asset(\Storage::url('logo/logo.png'));
            $invoicr->setLogo($img);
            //Set theme color
            $invoicr->setColor($settings['invoice_color']);
            //Set type
            $invoicr->setType("Invoice");
            //Set reference
            $invoicr->setReference(Auth::user()->invoiceNumberFormat($invoice->id));
            //Set date
            $invoicr->setDate(Auth::user()->dateFormat($invoice->issue_date));
            //Set due date
            $invoicr->setDue(Auth::user()->dateFormat($invoice->due_date));
            //Set from
            $invoicr->setFrom(
                array(
                    $settings['company_name'],
                    $settings['company_address'],
                    $settings['company_city'] . ", " . $settings['company_state'],
                    $settings['company_country'],
                    $settings['company_zipcode'],
                )
            );

            //Set to
            $invoicr->setTo(
                array(
                    (isset($user->name)) ? $user->name : "",
                    (isset($user->email)) ? $user->email : "",
                    "",
                    "",
                    "",
                )
            );

            //Add items
            foreach($invoice->items as $items)
            {
                $invoicr->addItem(ucfirst($items->iteam), false, 0, 0, 0, false, $items->price);
            }

            //Add totals
            $subTotal = $invoice->getSubTotal();
            $tax      = $invoice->getTax();
            $totalDue = $subTotal - $invoice->discount + $tax;

            $invoicr->addTotal(__("Discount"), $invoice->discount);
            $invoicr->addTotal(__("Sub Total"), $subTotal);
            $invoicr->addTotal((!empty($invoice->tax) ? __($invoice->tax->name) : __('Tax')) . " (" . (!empty($invoice->tax->rate) ? __($invoice->tax->rate) : '0') . "%)", $tax);
            $invoicr->addTotal(__("Total"), $totalDue, true);
            $invoicr->addTotal(__("Due Amount"), $invoice->getDue());

            //Set badge
            if($invoice->status == 0)
            {
                $invoicr->addBadge(__(\App\Invoice::$statues[$invoice->status]));
            }
            elseif($invoice->status == 1)
            {
                $invoicr->addBadge(__(\App\Invoice::$statues[$invoice->status]));
            }
            elseif($invoice->status == 2)
            {
                $invoicr->addBadge(__(\App\Invoice::$statues[$invoice->status]));
            }
            elseif($invoice->status == 3)
            {
                $invoicr->addBadge(__(\App\Invoice::$statues[$invoice->status]));
            }
            elseif($invoice->status == 4)
            {
                $invoicr->addBadge(__(\App\Invoice::$statues[$invoice->status]));
            }

            //Add title
            if(isset($settings['invoice_title']) && !empty($settings['invoice_title']))
            {
                $invoicr->addTitle($settings['invoice_title']);
            }

            //Add Paragraph
            if(isset($settings['invoice_text']) && !empty($settings['invoice_text']))
            {
                $invoicr->addParagraph($settings['invoice_text']);
            }

            //Set footer note
            $invoicr->setFooternote(url('/'));

            //Render
            $invoicr->render(Auth::user()->invoiceNumberFormat($invoice->id) . '.pdf', 'I');
            die;
        }
        else
        {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }
}
