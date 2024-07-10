<?php
$apps = Session::get('job');
$idnum = (int)1;
?>
<html><title>Applicant List</title>
<style>
    @page { margin: 30px !important; }
    html { margin: 30px !important; font-family: Arial, sans-serif;}
    .upper, .info, .table {
        width: 100%;
    }   
    .upper td, .info td, .table td {
        border:1px solid #000;
    }
    .upper td {
        padding:10px;
    }
    .info {
        margin-top: 90px;
    }
    .info td {
        padding: 5px;
        vertical-align: top;
    }
    .table th {
        border:1px solid #000;
    }
    .table td {
        padding: 5px;
        vertical-align: top;
    }
    .ow {
      overflow-wrap: break-word;
      word-wrap: break-word;
      hyphens: auto;
    }
    .fs {
        font-family: Arial, sans-serif;
        font-size: 11px;
    }
    .alc {
        text-align: center;
    }
</style>
<body>
<p style="direction: rtl;">{{ date("F d,Y") }}</p>
<table class="upper" cellpadding="0" cellspacing="0">
    <tr>
        <td width="20%" style="border: none;"><center><img src="{{ asset('public/img/doh.png') }}" width="100"></center></td>
        <td width="60%" style="font-size: 11pt; border: none;">
            <center>
                <strong>Republic of the Philippines</strong><br>
                DEPARTMENT OF HEALTH<br>
                <strong>CENTER FOR HEALTH DEVELOPMENT <br> SOCCSKSARGEN Region</strong><br>
                <h5>EXAMINATION ATTENDANCE FOR THE VACANT POSITIONS OF</h5>
                <h5>{{$apps->job_title}} ({{$apps->term()}})</h5>
                <h5>{{$apps->area_ass}}</h5>
                <h5>Date: ______________________</h5>
            </center>
        </td>
        <td width="20%" style="border: none;"><center><img src="{{ asset('public/img/ro12.png') }}" width="100"></center></td>
    </tr>

</table>

<table width="100%"  cellspacing="0" class="table" style="table-layout:fixed;">
    <tr>
        <th width="2%" class="fs">NO</th>
        <th width="13%" class="fs">SURNAME</th>
        <th class="fs" width="13%">FIRST NAME</th>
        <th width="13%" class="fs">MIDDLE NAME</th>pa
        <th width="13%" class="fs">CONTACT NO</th>
        <th width="13%" class="fs">ADDRESS</th>
        <th width="14%" class="fs">EMAIL ADDRESS</th>
        <th width="13%" class="fs">SIGNATURE</th>
        <th width="13%" class="fs">REMARKS</th>
    </tr>
    @foreach($apps->applicants->orderBy('lname', 'asc') as $a)
    @if($a->status == '1' || $a->status == '3') 
    <tr>
    	<td class="fs alc" style="padding-top: 30px;">{{$idnum}}</td>
    	<td class="ow fs" style="padding-top: 30px;">{{$a->applicant->lname}}</td>
    	<td class="ow fs" style="padding-top: 30px;">{{$a->applicant->fname}}</td>
    	<td class="ow fs" style="padding-top: 30px;">{{$a->applicant->mname}}</td>
    	<td class="ow fs" style="padding-top: 30px;">{{$a->applicant->contactno}}</td>
        <td class="ow fs" style="padding-top: 30px;">{{$a->applicant->profile->address}}</td>
    	<td class="ow fs" style="padding-top: 30px;color:#0000FF; text-decoration:underline;">{{$a->applicant->email}}</td>
    	<td></td>
    	<td></td>
    </tr>
    <?php $idnum += (int)1; ?>
    @endif
    @endforeach
</table>
</body>
</html>