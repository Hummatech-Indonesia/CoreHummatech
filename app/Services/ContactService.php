<?php

namespace App\Services;

use App\Contracts\Interfaces\DataCOInterface;
use App\Contracts\Interfaces\LimitInterface;
use Carbon\Carbon;
use App\Enum\TypeEnum;
use App\Enum\RolesEnum;
use App\Models\Student;
use App\Mail\DeclineApproval;
use App\Enum\StudentStatusEnum;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Contracts\Interfaces\UserInterface;
use App\Http\Requests\AcceptedAprovalRequest;
use App\Http\Requests\DeclinedAprovalRequest;
use App\Contracts\Interfaces\ResponseLetterInterface;
use App\Contracts\Interfaces\Signature_COInterface;
use App\Contracts\Interfaces\StudentInterface;
use App\Enum\InternshipTypeEnum;
use App\Http\Requests\StoreContactUsRequest;
use App\Mail\SendEmail;
use App\Models\Limits;
use App\Models\ResponseLetter;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ContactService
{
    public function SendMail(Request $request, $mail)
    {
        $data = $request->all();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'description' => $request->description,
        ];
        Mail::to($mail)->send(new SendEmail($data));

        return $data;
    }
}
