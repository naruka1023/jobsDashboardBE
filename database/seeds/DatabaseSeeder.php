<?php
use App\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Job;
use App\Applicantion;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $applications = Application::all();
        $index = count($applications);
        foreach($applications as $application){
            $application->status = 0;
            $application->save();
            echo --$index . ' applicants left' . "\r\n";
        }
        // $jobs = Job::all();
        
        // $index = count($jobs);
        // foreach($jobs as $job){
        //     $job->available = rand(0, 1);
        //     $job->save();
        //     echo $index . 'job availability saved' . "\r\n";
        //     $index--;
        // }
        // // $applicants = factory(Applicant::class, 50)->create();
        // $jobsID = DB::table('jobs')->select('jID')->get();
        // $applicantsID = DB::table('applicants')->select('aID')->get();

        // $index = 500;
        // while($index != 0){
        //     $index--;
        //     $jobID = $jobsID[rand(0, 129)];
        //     $applicantID = $applicantsID[rand(0, 199)];
        //     $applicationID = rand(40000, 49999);
            
        //     $application = new Application;
        //     $application->apID = $applicationID;
        //     $application->aID = $applicantID->aID;
        //     $application->jID = $jobID->jID;
        //     $application->save();
        // }
    }
}
