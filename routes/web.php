<?php
use App\Enums\EnrollmentStatus;
use App\Enums\UserRole;
use App\Livewire\Admin\RequirementVerification;
use App\Livewire\Admin\StudentSubmissions;
use App\Livewire\Admin\StudentList;
use App\Models\Semester;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\RequirementSubmission;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome')->name('home');

/**
 * Default post-login redirect route.
 * Redirects the user to their role-specific dashboard based on their role.
 * Aborts with 403 if the role is unknown or unhandled.
 */
 Route::middleware(['auth', 'approved'])->get('/dashboard', function () {
     return match(Auth::user()->role) {
        UserRole::Admin => redirect()->route('admin.dashboard'),
        UserRole::Student => redirect()->route('student.dashboard'),
        default   => abort(403),
    };
 })->name('dashboard');



// Student Related Routes
Route::middleware(['auth', 'approved', 'student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::view('/dashboard', 'student.dashboard')->name('dashboard');
    Route::get('/coe', function () {
        // SECURITY: Ensure they are actually enrolled before showing the certificate
       if (!Auth::user()->enrollments->status !== EnrollmentStatus::Approved) {
            abort(403, 'You must be fully enrolled to access the COE.');
        }
        return view('student.coe', [
            'student' => Auth::user(),
            'semester' => Semester::where('is_active', true)->first()
        ]);
    })->name('coe.download'); 

    });

// Admin Related Routes
Route::middleware(['auth', 'approved', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard', [
                'pendingStudents' => User::where('status', 'pending')->count(),
                'totalEnrolled' => Enrollment::where('status', 'approved')->count(),
                'pendingRequirements' => RequirementSubmission::where('status', 'pending')->count(),
                'recentEnrollments' => Enrollment::with('user')
                    ->where('status', 'approved')
                    ->latest()
                    ->take(10)
                    ->get(),
            ]);
        })->name('dashboard');
        Route::get('/students', StudentList::class)->name('students');
        Route::get('/submissions', StudentSubmissions::class)->name('submissions');
        Route::get('/verify/{user}', RequirementVerification::class)->name('verify');
    });



require __DIR__.'/settings.php';
