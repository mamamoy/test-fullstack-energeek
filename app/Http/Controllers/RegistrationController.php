<?php

namespace App\Http\Controllers;

use App\Models\Candidates;
use App\Models\Jobs;
use App\Models\Skill;
use App\Models\SkillSet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegistrationController extends Controller
{
    public function index()
    {
        $jobs = Jobs::get();
        $skills = Skill::get();

        return Inertia::render('Registration', [
            'jobs' => $jobs,
            'skills' => $skills,
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'fullname' => 'required|string',
            'position' => 'required',
            'email' => 'required|string|unique:candidates,email',
            'telephone' => 'required|numeric|unique:candidates,phone',
            'bornYear' => 'required',
            'skill_set.*' => 'required'
        ], [
            'email.unique' => 'Email sudah digunakan, silahkan gunakan email lain.',
            'telephone.unique' => 'Nomor telepon sudah digunakan, silahkan gunakan nomor telepon lain.',
        ]);

        // dd($request->skill_sets);

        $bornInput = $request->bornYear;
        $year = date('Y', strtotime($bornInput));
        // dd($year);

        $candidate = Candidates::create([
            'job_id' => $request->position,
            'name' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->telephone,
            'year' => $year,
        ]);
        $candidate_id = $candidate->id;
        

        foreach ($request->skill_sets as $skill) {
            $skillSets = SkillSet::create([
                'candidate_id' => $candidate_id,
                'skill_id' => $skill,
            ]);
        }

        if ($candidate && $skillSets) {
            return response()->json([
                'status' => 'success',
                'message' => 'Lamaran berhasil dikirim',
                'redirect' => route('registration.index') // URL untuk redirect
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Lamaran tidak berhasil dikirim'
            ], 400);
        }
    }
}
