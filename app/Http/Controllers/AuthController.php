<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail as MailTestMail;
// use Illuminate\Support\Facades\TestMail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
        //all users
public function index()
{
    $users = User::all()->map(function ($user) {
        return [
            'full_name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'created_at' => $user->created_at->format('Y-m-d H:i:s'), // Format as needed
        ];
    });

    return response()->json([
        'message' => 'Users retrieved successfully',
        'users' => $users,
    ]);
}

    // Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required',
            'birth_date' => 'required|date|before:today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
        ]);

        // Create a token for the registered user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'user' => $user,
            'token' => $token,
        ], 201);
    }
//admin
    public function loginadmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        if ($user->role === 'admin') {
            $token = $user->createToken('admin_token')->plainTextToken;

            return response()->json([
                'message' => 'Admin login successful',
                'role' => 'admin',
                'token' => $token,
            ], 200);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'role' => 'user',
            'token' => $token,
        ], 200);
    }


    // Login user
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Login successful', 'token' => $token], 200);
    }

    // Logout
    public function logout(Request $request)
    {
        // Revoke all tokens for the authenticated user
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    public function forgetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        // Generate OTP
        $otp = rand(1000, 9999);

        // Hash the OTP before saving
        $user->update([
            'otp' => Hash::make($otp),
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via email using Mailable (TestMail)
        Mail::to($user->email)->send(new TestMail($otp, $user->email)); // Pass recipient email

        return response()->json(['message' => 'OTP sent to your email'], 200);
    }

  public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|integer',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    if (!$user->otp || !Hash::check($request->otp, $user->otp) || now()->greaterThan($user->otp_expires_at)) {
        return response()->json(['message' => 'Invalid OTP or OTP expired'], 400);
    }

    return response()->json(['message' => 'OTP verified successfully'], 200);
}



//resetPassword
public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'Password reset successfully'], 200);
}




}



