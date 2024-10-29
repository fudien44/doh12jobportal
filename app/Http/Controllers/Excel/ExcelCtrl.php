<?php

namespace App\Http\Controllers\Excel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs;

class ExcelCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rdr (Request $request, $appid)
    {

        $id = base64_decode($appid);
        $apps = Jobs::find($id);

        

        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=rdr_report.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        echo '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>';
        echo '<body>';

        $datePosted = strtotime($apps->date_posted);
        $dateClosed = strtotime($apps->date_closed);

        if (date('Y', $datePosted) == date('Y', $dateClosed) && date('n', $datePosted) == date('n', $dateClosed)) {
            $dateOutput = date('F j', $datePosted) . ' - ' . date('j', $dateClosed) . ', ' . date('Y', $dateClosed);
        } elseif (date('Y', $datePosted) == date('Y', $dateClosed)) {
            $dateOutput = date('F j', $datePosted) . ' - ' . date('F j', $dateClosed) . ', ' . date('Y', $dateClosed);
        } else {
            $dateOutput = date('F j, Y', $datePosted) . ' - ' . date('F j, Y', $dateClosed);
        }

        $title = 'REPORT ON THE DOCUMENTARY REVIEW (RDR) ' . $apps->job_title . ' - ' . $apps->area_ass . '
        <br>DEPARTMENT OF HEALTH - CENTER FOR HEALTH DEVELOPMENT SOCCSKSARGEN Region 
        <br>Date: ' . $dateOutput;

        $table_body = "";
        foreach ($apps->applicants as $index => $a) {
        // dd($apps);
        $ethnicity_pwd_solopar = "No";
        if($a->applicant->profile->ethnicity || $a->applicant->profile->is_pwd == 1|| $a->applicant->profile->is_solopar == 1)
                {
                $ethnicity_pwd_solopar = "Yes";
                }
        $j = $a->applicant->myjobs->where('job_id',$apps->id)->first();

        $remarks = $j->latst ? $j->latst->tp() : '';

            $table_body .= "<tr>
                <td style='text-align: center;'>" . ($index + 1) . "</td>
               <td>
                    ".$a->applicant->fname." ".$a->applicant->mname." ".$a->applicant->lname."<br>
                    Contact Number: ".$a->applicant->contactno."<br>
                    Email Address: ".$a->applicant->email ."<br>
                    Age: ".\Carbon\Carbon::parse($a->applicant->dob)->age."<br>
                    Gender: ".$a->applicant->profile->gndr() ."<br>
                    Address: ".$a->applicant->profile->address ."<br>
                    Years of Experience: ".$a->applicant->profile->work_experience."<br>
                </td>
                <td>
                    Course Title:".$a->applicant->profile->course."<br>
                    Name of School/University:".$a->applicant->profile->school."<br>
                    Eligibility/License/Honor Graduate: ".$a->applicant->profile->eligibity."
                </td>
                <td style='text-align: center;'>{$ethnicity_pwd_solopar}</td>
                <td>{$a->relevant_work_experience}</td>
                <td>{$a->relevant_training}</td>
                <td style='text-align: center;'>$remarks</td>
            </tr>";
        }

                $footer = "
            <br><br>
            <table border='0' width='100%'>
                <tr>
                    <td></td>
                    <td>Review and Validated by:</td>
                </tr>
                <tr>
                </tr>
                 <tr>
                </tr>
                 <tr>
                </tr>
                <tr>
                    <td></td>
                    <td style='text-align: center;' colspan='1'><b>AMEBELLA G. TARUC, MD, MPM</b></td>
                    <td></td>
                    <td style='text-align: center;' colspan='1'><b>GODWIN LORD Y. GALLO, RN, MPH</b></td>
                    <td></td>
                    <td style='text-align: center;'><b>JOEL E. GENZON, EdD, MAEd. LPT</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style='text-align: center;' colspan='1'>Medical Officer V/Member HRMPSB</td>
                    <td></td>
                    <td style='text-align: center;'colspan='1'>Chief Administrative Officer/Member HRMPSB</td>
                    <td></td>
                    <td style='text-align: center;'>DMO III, 2nd level Representative</td>
                </tr>
                 <tr>
                </tr> 
                 <tr>
                </tr>
                 <tr>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td></td>
                    <td style='text-align: center;' colspan='1'><b>CHERRY G. YEE, MPA</b></td>
                    <td ></td>
                    <td colspan='1'></td>
                    <td></td>
                    <td style='text-align: center;'><b>DIMELCA C. GANGOSO, MD, MPH</b></td>
                </tr>
                <tr>
                    <td></td>
                    <td style='text-align: center;' colspan='1'>Administrative Officer V/Member HRMPSB</td>
                    <td></td>
                    <td colspan='1'></td>
                    <td></td>
                    <td style='text-align: center;'>Medical Specialist III/NADEA 12 Representative</td>
                </tr>
                 <tr>
                </tr>
                <tr>
                    <td></td>
                    <td colspan='1'></td>
                    <td style='text-align: right'>Approved by:</td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <td colspan='1'></td>
                    <td></td>
                    <td></td>
                    <td style='text-align: center;' colspan='1'><b>FATIMA A. EMBAN, MD, MPH</b></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan='1'></td>
                    <td></td>
                    <td></td>
                    <td style='text-align: center;' colspan='1'> OIC - Director III/Chairperson HRMPSB </td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        ";

        $display = "
            <h2 style='text-align: center;'>{$title}</h2>
            <h3>Minimum Qualifications (based on CSC Qualification Standards)</h3>
            <ul>
                <li>Education: {$apps->education}</li>
                <li>Experience: {$apps->experience}</li>
                <li>Training: {$apps->training}</li>
                <li>Eligibility: {$apps->eligibility}</li>
            </ul>
            <h3>Additional Requirements (based on DOH -CHD Regional Memorandum No.: 142 s. 2018)</h3>
            <ul>
                <li>Education: {$apps->add_req}</li>
            </ul>
            <table cellspacing='1' cellpadding='5' border='1'>
            <tr>
                <td style='background-color:lightgreen; text-align: center;'>NO.</td>
                <td style='background-color:lightgreen; text-align: center;'>NAME</td>
                <td style='background-color:lightgreen; text-align: center;'>EDUCATION/ ELIGIBILITY</td>
                <td style='background-color:lightgreen; text-align: center;'>ETHNICITY/PWD/ SOLO PARENT</td>
                <td style='background-color:lightgreen; text-align: center;'>RELEVANT WORK EXPERIENCE</td>
                <td style='background-color:lightgreen; text-align: center;'>RELEVANT TRAINING</td>
                <td style='background-color: lightgreen; text-align: center;'>REMARKS</td>
            </tr>
            {$table_body}
            </table>
            {$footer}
               </body></html> 
        ";

        return $display;
    }
}
