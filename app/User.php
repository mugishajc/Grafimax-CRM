<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $appends = ['profile'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'avatar',
        'lang',
        'delete_status',
        'plan',
        'plan_expire_date',
        'created_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public    $settings;

    public function authId()
    {
        return $this->id;
    }

    public function creatorId()
    {
        if($this->type == 'company' || $this->type == 'super admin')
        {
            return $this->id;
        }
        else
        {
            return $this->created_by;
        }
    }

    public function currentLanguage()
    {
        return $this->lang;
    }

    public function projects()
    {
        return $this->belongsToMany('App\Projects', 'userprojects', 'user_id', 'project_id');
    }

    public function user_project()
    {
        if(\Auth::user()->type != 'client')
        {
            return $this->belongsToMany('App\Projects', 'userprojects', 'user_id', 'project_id')->count();
        }
        else
        {
            return Projects::where('client', '=', $this->authId())->count();
        }
    }

    public function user_assign_task()
    {
        return Task::where('assign_to', '=', $this->authId())->count();
    }

    public function client_lead()
    {
        return Leads::where('client', '=', $this->authId())->count();
    }

    public function user_expense()
    {
        return $this->hasMany('App\Expense', 'user_id', 'id')->sum('amount');
    }

    public function client_project()
    {
        return $this->hasMany('App\Projects', 'client', 'id')->count();
    }

    public function client_project_budget()
    {
        return $this->hasMany('App\Projects', 'client', 'id')->sum('price');
    }

    public function priceFormat($price)
    {
        $settings = Utility::settings();

        return (($settings['site_currency_symbol_position'] == "pre") ? $settings['site_currency_symbol'] : '') . number_format($price, 2) . (($settings['site_currency_symbol_position'] == "post") ? $settings['site_currency_symbol'] : '');
    }

    public function dateFormat($date)
    {
        $settings = Utility::settings();

        return date($settings['site_date_format'], strtotime($date));
    }

    public function timeFormat($time)
    {
        $settings = Utility::settings();

        return date($settings['site_time_format'], strtotime($time));
    }

    public function invoiceNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["invoice_prefix"] . sprintf("%05d", $number);
    }

    public function clientPermission($project_id)
    {

        return ClientPermission::where('client_id', '=', $this->id)->where('project_id', '=', $project_id)->first();
    }

    public function last_leadstage()
    {
        return Leadstages::where('created_by', '=', $this->creatorId())->orderBy('order', 'DESC')->first();
    }

    public function total_lead()
    {
        if(\Auth::user()->type == 'company')
        {
            return Leads::where('created_by', '=', $this->creatorId())->count();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Leads::where('client', '=', $this->authId())->count();
        }
        else
        {
            return Leads::where('owner', '=', $this->authId())->count();
        }
    }

    public function total_complete_lead($last_leadstage)
    {
        if(\Auth::user()->type == 'company')
        {
            return Leads::where('created_by', '=', $this->creatorId())->where('stage', '=', $last_leadstage)->count();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Leads::where('client', '=', $this->authId())->where('stage', '=', $last_leadstage)->count();
        }
        else
        {
            return Leads::where('owner', '=', $this->authId())->where('stage', '=', $last_leadstage)->count();
        }
    }

    public function created_total_project_task()
    {
        if(\Auth::user()->type == 'company')
        {
            return Task::join('projects', 'projects.id', '=', 'tasks.project_id')->where('projects.created_by', '=', $this->creatorId())->count();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Task::join('projects', 'projects.id', '=', 'tasks.project_id')->where('projects.client', '=', $this->authId())->count();
        }
        else
        {
            return Task::select('tasks.*', 'userprojects.id as up_id')->join('userprojects', 'userprojects.project_id', '=', 'tasks.project_id')->where('userprojects.user_id', '=', $this->authId())->count();
        }

    }

    public function created_top_due_task()
    {
        if(\Auth::user()->type == 'company')
        {
            return Task::select('projects.*', 'tasks.id as task_id', 'tasks.title', 'tasks.due_date as task_due_date', 'tasks.assign_to', 'projectstages.name as stage_name')->join('projects', 'projects.id', '=', 'tasks.project_id')->join('projectstages', 'tasks.stage', '=', 'projectstages.id')->where('projects.created_by', '=', $this->creatorId())->where('tasks.due_date', '>', date('Y-m-d'))->limit(5)->orderBy('task_due_date', 'ASC')->get();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Task::select('projects.*', 'tasks.id as task_id', 'tasks.title', 'tasks.due_date as task_due_date', 'tasks.assign_to', 'projectstages.name as stage_name')->join('projects', 'projects.id', '=', 'tasks.project_id')->join('projectstages', 'tasks.stage', '=', 'projectstages.id')->where('projects.client', '=', $this->authId())->where('tasks.due_date', '>', date('Y-m-d'))->limit(5)->orderBy('task_due_date', 'ASC')->get();
        }
        else
        {
            return Task::select('tasks.*', 'tasks.due_date as task_due_date', 'userprojects.id as up_id', 'projects.name as project_name', 'projectstages.name as stage_name')->join('userprojects', 'userprojects.project_id', '=', 'tasks.project_id')->join('projects', 'userprojects.project_id', '=', 'projects.id')->join('projectstages', 'tasks.stage', '=', 'projectstages.id')->where('userprojects.user_id', '=', $this->authId())->where('tasks.due_date', '>', date('Y-m-d'))->limit(5)->orderBy(
                'tasks.due_date', 'ASC'
            )->get();
        }
    }

    public function project_due_task()
    {
        if(\Auth::user()->type == 'company')
        {
            return Task::select('projects.*', 'tasks.id as task_id', 'tasks.title', 'tasks.priority', 'tasks.due_date as task_due_date', 'tasks.assign_to', 'projectstages.name as stage_name')->join('projects', 'projects.id', '=', 'tasks.project_id')->join('projectstages', 'tasks.stage', '=', 'projectstages.id')->where('projects.created_by', '=', $this->creatorId())->orderBy('task_due_date', 'ASC')->get();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Task::select('projects.*', 'tasks.id as task_id', 'tasks.title', 'tasks.priority', 'tasks.priority', 'tasks.due_date as task_due_date', 'tasks.assign_to', 'projectstages.name as stage_name')->join('projects', 'projects.id', '=', 'tasks.project_id')->join('projectstages', 'tasks.stage', '=', 'projectstages.id')->where('projects.client', '=', $this->authId())->orderBy('task_due_date', 'ASC')->get();
        }
        else
        {
            return Task::select('tasks.*', 'tasks.id as task_id', 'tasks.due_date as task_due_date', 'userprojects.id as up_id', 'projects.name as name', 'projectstages.name as stage_name')->join('userprojects', 'userprojects.project_id', '=', 'tasks.project_id')->join('projects', 'userprojects.project_id', '=', 'projects.id')->join('projectstages', 'tasks.stage', '=', 'projectstages.id')->where('userprojects.user_id', '=', $this->authId())->orderBy(
                'tasks.due_date', 'ASC'
            )->get();
        }
    }

    public function total_project()
    {
        return Projects::where('created_by', '=', $this->creatorId())->count();
    }

    public function last_projectstage()
    {
        return Projectstages::where('created_by', '=', $this->creatorId())->orderBy('order', 'DESC')->first();
    }

    public function project_complete_task($project_last_stage)
    {

        if(\Auth::user()->type == 'company')
        {
            return Task::join('projects', 'projects.id', '=', 'tasks.project_id')->where('projects.created_by', '=', $this->creatorId())->where('tasks.stage', '=', $project_last_stage)->count();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Task::join('projects', 'projects.id', '=', 'tasks.project_id')->where('projects.client', '=', $this->authId())->where('tasks.stage', '=', $project_last_stage)->count();
        }
        else
        {
            return Task::select('tasks.*', 'userprojects.id as up_id')->join('userprojects', 'userprojects.project_id', '=', 'tasks.project_id')->where('userprojects.user_id', '=', $this->authId())->where('tasks.stage', '=', $project_last_stage)->count();
        }
    }

    public function created_total_invoice()
    {
        if(\Auth::user()->type == 'company')
        {
            return Invoice::where('created_by', '=', $this->creatorId())->limit(5)->get();
        }
        elseif(\Auth::user()->type == 'client')
        {
            return Invoice::select('invoices.*', 'projects.client')->join('projects', 'projects.id', '=', 'invoices.project_id')->where(
                'projects.client', '=', $this->authId()
            )->get();
        }
    }

    public function getPlan()
    {
        return $this->hasOne('App\Plan', 'id', 'plan');
    }

    public function assignPlan($planID)
    {
        $plan = Plan::find($planID);
        if($plan)
        {
            $this->plan = $plan->id;
            if($plan->duration == 'month')
            {
                $this->plan_expire_date = Carbon::now()->addMonths(1)->isoFormat('YYYY-MM-DD');
            }
            elseif($plan->duration == 'year')
            {
                $this->plan_expire_date = Carbon::now()->addYears(1)->isoFormat('YYYY-MM-DD');
            }
            $this->save();

            $projects = Projects::where('created_by', '=', \Auth::user()->creatorId())->get();
            $users    = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', '!=', 'client')->get();
            $clients  = User::where('created_by', '=', \Auth::user()->creatorId())->where('type', 'client')->get();

            $projectCount = 0;
            foreach($projects as $project)
            {
                $projectCount++;
                if($projectCount <= $plan->max_projects)
                {
                    $project->is_active = 1;
                    $project->save();
                }
                else
                {
                    $project->is_active = 0;
                    $project->save();
                }
            }

            $userCount = 0;
            foreach($users as $user)
            {
                $userCount++;
                if($userCount <= $plan->max_users)
                {
                    $user->is_active = 1;
                    $user->save();
                }
                else
                {
                    $user->is_active = 0;
                    $user->save();
                }
            }
            $clientCount = 0;
            foreach($clients as $client)
            {
                $clientCount++;
                if($clientCount <= $plan->max_clients)
                {
                    $client->is_active = 1;
                    $client->save();
                }
                else
                {
                    $client->is_active = 0;
                    $client->save();
                }
            }

            return ['is_success' => true];
        }
        else
        {
            return [
                'is_success' => false,
                'error' => 'Plan is deleted.',
            ];
        }
    }

    public function countUsers()
    {

        return User::where('type', '!=', 'client')->where('created_by', '=', \Auth::user()->id)->count();
    }

    public function countClient()
    {

        return User::where('type', '=', 'client')->where('created_by', '=', \Auth::user()->id)->count();
    }

    public function countProject()
    {
        return Projects::where('created_by', '=', \Auth::user()->id)->count();
    }

    public function countCompany()
    {
        return User::where('type', '=', 'company')->where('created_by', '=', \Auth::user()->id)->count();
    }

    public function countPaidCompany()
    {
        return User::where('type', '=', 'company')->whereNotIn(
            'plan', [
                      0,
                      1,
                  ]
        )->where('created_by', '=', \Auth::user()->id)->count();
    }

    public function makeEmployeeRole()
    {
        $employeeRole = Role::create(
            [
                'name' => 'employee',
                'created_by' => $this->id,
            ]
        );

        $empPermission = [
            'manage account',
            'change password account',
            'edit account',
            'manage project',
            'show project',
            'manage task',
            'move task',
            'show task',
            'create checklist',
            'manage note',
            'create note',
            'edit note',
            'delete note',
            'manage lead',
            'manage bug report',
            'create bug report',
            'edit bug report',
            'delete bug report',
            'move bug report',
            'manage timesheet',
            'create timesheet',
            'edit timesheet',
            'delete timesheet',
        ];
        foreach($empPermission as $ap)
        {
            $permission = Permission::findByName($ap);
            $employeeRole->givePermissionTo($permission);
        }
    }

    public function userDefaultData()
    {
        $id = $this->id;

        $colors = [
            '#e7505a',
            '#F4D03F',
            '#32c5d2',
            '#1BBC9B',
        ];

        // LeadStages
        $leadStages = [
            'Initial Contact',
            'Qualification',
            'Proposal',
            'Close',
        ];
        foreach($leadStages as $key => $stage)
        {
            Leadstages::create(
                [
                    'name' => $stage,
                    'color' => $colors[$key],
                    'order' => $key,
                    'created_by' => $id,
                ]
            );
        }

        // ProjectStages
        $projectStages = [
            'To Do',
            'In Progress',
            'Bugs',
            'Done',
        ];
        foreach($projectStages as $key => $stage)
        {
            Projectstages::create(
                [
                    'name' => $stage,
                    'color' => $colors[$key],
                    'order' => $key,
                    'created_by' => $id,
                ]
            );
        }

        // LeadSource
        $leadSource = [
            'Email',
            'Facebook',
            'Google',
            'Phone',
        ];
        foreach($leadSource as $source)
        {
            Leadsource::create(
                [
                    'name' => $source,
                    'created_by' => $id,
                ]
            );
        }

        // Labels
        $labels = [
            'On Hold' => 'bg-red-thunderbird bg-font-red-thunderbird',
            'New' => 'bg-yellow-casablanca bg-font-yellow-casablanca',
            'Pending' => 'bg-purple-intense bg-font-purple-intense',
            'Loss' => 'bg-purple-medium bg-font-purple-medium',
            'Win' => 'bg-yellow-soft bg-font-yellow-soft',
        ];
        foreach($labels as $label => $color)
        {
            Labels::create(
                [
                    'name' => $label,
                    'color' => $color,
                    'created_by' => $id,
                ]
            );
        }

        // ProductUnits
        $productUnits = [
            'Kilogram',
            'Piece',
            'Set',
            'Item',
            'Hour',
        ];
        foreach($productUnits as $unit)
        {
            Productunits::create(
                [
                    'name' => $unit,
                    'created_by' => $id,
                ]
            );
        }

        // ExpenseCategory
        $expenseCat = [
            'Snack',
            'Server Charge',
            'Bills',
            'Office',
            'Assests',
        ];
        foreach($expenseCat as $cat)
        {
            ExpensesCategory::create(
                [
                    'name' => $cat,
                    'created_by' => $id,
                ]
            );
        }

        // Payments
        $payments = [
            'Cash',
            'Bank',
        ];
        foreach($payments as $payment)
        {
            Payment::create(
                [
                    'name' => $payment,
                    'created_by' => $id,
                ]
            );
        }

        // Bug Status
        $bugStatus = [
            'Confirmed',
            'Resolved',
            'Unconfirmed',
            'In Progress',
            'Verified',
        ];
        foreach($bugStatus as $status)
        {
            BugStatus::create(
                [
                    'title' => $status,
                    'created_by' => $id,
                ]
            );
        }
    }

    public function destroyUserProjectInfo($user_id)
    {
        return Userprojects::where('user_id', '=', $user_id)->delete();
    }

    public function removeUserLeadInfo($user_id)
    {
        return Leads::where('owner', '=', $user_id)->update(array('owner' => 0));
    }

    public function removeUserExpenseInfo($user_id)
    {
        return Expense::where('user_id', '=', $user_id)->update(array('user_id' => 0));
    }

    public function removeUserTaskInfo($user_id)
    {
        return Task::where('assign_to', '=', $user_id)->update(array('assign_to' => 0));
    }

    public function destroyUserNotesInfo($user_id)
    {
        return Note::where('created_by', '=', $user_id)->delete();
    }

    public function destroyUserTaskAllInfo($user_id)
    {
        CheckList::where('created_by', '=', $user_id)->delete();
        Comment::where('created_by', '=', $user_id)->delete();
        TaskFile::where('created_by', '=', $user_id)->delete();
    }

    public function removeClientProjectInfo($user_id)
    {
        return Projects::where('client', '=', $user_id)->update(array('client' => 0));
    }

    public function removeClientLeadInfo($user_id)
    {
        return Leads::where('client', '=', $user_id)->update(array('client' => 0));
    }

    public function total_company_user($company_id)
    {
        return User::where('type', '!=', 'client')->where('created_by', '=', $company_id)->count();
    }

    public function total_company_client($company_id)
    {
        return User::where('type', '=', 'client')->where('created_by', '=', $company_id)->count();
    }

    public function total_company_project($company_id)
    {
        return Projects::where('created_by', '=', $company_id)->count();
    }

    public function bugNumberFormat($number)
    {
        $settings = Utility::settings();

        return $settings["bug_prefix"] . sprintf("%05d", $number);
    }

    public function header_title()
    {
        $settings = Utility::settings();

        if(!isset($settings["header_text"]) || empty($settings["header_text"]))
        {
            $settings["header_text"] = '';
        }

        return $settings["header_text"];
    }

    public function footer_title()
    {
        $settings = Utility::settings();

        if(!isset($settings["footer_text"]) || empty($settings["footer_text"]))
        {
            $settings["footer_text"] = '';
        }

        return $settings["footer_text"];
    }
}
