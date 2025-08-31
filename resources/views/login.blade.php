<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BlogSphere - Login & Signup</title>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
body {
  font-family: 'Inter', sans-serif;
  background: #f9fafb;
  min-height: 100vh;
}

/* Card */
.auth-card { 
  background: rgba(255, 255, 255, 0.95); 
  backdrop-filter: blur(20px); 
  border-radius: 24px; 
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  transition: all 0.3s ease;
}

/* Active Tab */
.tab-active { 
  background: #667eea; 
  color: white; 
  transform: scale(1.02);
}

/* Inputs */
.form-input { 
  transition: all 0.3s ease;
  border: 2px solid #e2e8f0; 
}
.form-input:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
  transform: translateY(-1px);
}

/* Primary Button */
.btn-primary {
  background: #667eea;
  color: white;
  transition: all 0.3s ease; 
}
.btn-primary:hover { 
  background: #5a67d8; /* slightly darker shade */
  transform: translateY(-2px);
  box-shadow: 0 8px 20px -5px rgba(102, 126, 234, 0.3); 
}

/* Social Buttons */
.social-btn { 
  transition: all 0.3s ease;
  border: 1px solid #e2e8f0; 
}
.social-btn:hover {
  transform: translateY(-1px); 
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Error & Success */
.input-error {
  border-color: #ef4444 !important; 
  box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
}
.error-message {
  color: #ef4444; 
  font-size: 0.875rem;
  margin-top: 0.25rem; 
}
.success-message { 
  color: #10b981; 
  font-size: 0.875rem; 
  margin-top: 0.25rem; 
}
</style>

</head>
<body class="flex items-center justify-center min-h-screen p-4">
<div class="auth-card w-full max-w-md p-8 mx-auto">
    <!-- Header Section -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-r from-purple-400 to-blue-500 flex items-center justify-center shadow-lg">
            <i class="fas fa-pen-nib text-white text-3xl"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-800 mb-2">BlogSphere</h1>
        <p class="text-gray-600">Share your stories with the world</p>
    </div>

    <!-- Flash Success -->
    @if (session('success'))
        <div class="mb-4 p-3 rounded-lg text-green-700 bg-green-100 border border-green-200">
            <i class="fas fa-check-circle mr-1"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Tab Navigation -->
    <div class="flex bg-gray-100 rounded-xl p-1 mb-6">
        <button id="loginTab" type="button" class="flex-1 py-3 px-4 rounded-xl font-medium text-gray-700 transition-all duration-300">
            <i class="fas fa-sign-in-alt mr-2"></i>Login
        </button>
        <button id="signupTab" type="button" class="flex-1 py-3 px-4 rounded-xl font-medium text-gray-700 transition-all duration-300">
            <i class="fas fa-user-plus mr-2"></i>Sign Up
        </button>
    </div>

    <!-- Login Form -->
    <form id="loginForm" method="POST" action="{{ route('login.post') }}" class="space-y-4">
        @csrf

        <div>
            <label for="login_email" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-blue-500"></i>Email Address
            </label>
            <input
                id="login_email"
                name="email"
                type="email"
                autocomplete="email"
                value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-xl form-input
                    @if($errors->has('email') && (session('activeTab') === 'login' || (isset($activeTab) && $activeTab === 'login'))) input-error @endif"
                placeholder="Enter your email"
               
            >
            @if (session('activeTab') === 'login' || (isset($activeTab) && $activeTab === 'login'))
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            @endif
        </div>

        <div>
            <label for="login_password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-blue-500"></i>Password
            </label>
            <input
                id="login_password"
                name="password"
                type="password"
                autocomplete="current-password"
                class="w-full px-4 py-3 rounded-xl form-input
                    @if($errors->has('password') && (session('activeTab') === 'login' || (isset($activeTab) && $activeTab === 'login'))) input-error @endif"
                placeholder="Enter your password"
                
            >
            @if (session('activeTab') === 'login' || (isset($activeTab) && $activeTab === 'login'))
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            @endif

            <div class="text-right mt-2">
                <a href="#" class="text-sm text-blue-600 hover:underline transition-colors">Forgot password?</a>
            </div>
        </div>

        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" class="rounded text-blue-600 focus:ring-blue-500">
            <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
        </div>

        <button type="submit" class="w-full py-3 px-4 rounded-xl text-white font-semibold btn-primary">
            <i class="fas fa-sign-in-alt mr-2"></i>Sign In
        </button>
    </form>

    <!-- Signup Form -->
    @php($regErrors = $errors->getBag('register'))
    <form id="signupForm" method="POST" action="{{ route('register.post') }}" class="space-y-4 hidden">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-user mr-2 text-blue-500"></i>Full Name
            </label>
            <input
                id="name"
                name="name"
                type="text"
                autocomplete="name"
                value="{{ old('name') }}"
                class="w-full px-4 py-3 rounded-xl form-input @if($regErrors->has('name')) input-error @endif"
                placeholder="Enter your full name"
            >
            @error('name', 'register')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-at mr-2 text-blue-500"></i>Username
            </label>
            <input
                id="username"
                name="username"
                type="text"
                autocomplete="username"
                value="{{ old('username') }}"
                class="w-full px-4 py-3 rounded-xl form-input @if($regErrors->has('username')) input-error @endif"
                placeholder="Choose a username"
            >
            <p id="usernameError" class="error-message"></p>
            @error('username', 'register')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="reg_email" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-envelope mr-2 text-blue-500"></i>Email Address
            </label>
            <input
                id="reg_email"
                name="email"
                type="email"
                autocomplete="email"
                value="{{ old('email') }}"
                class="w-full px-4 py-3 rounded-xl form-input @if($regErrors->has('email')) input-error @endif"
                placeholder="Enter your email"
            >
            @error('email', 'register')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-blue-500"></i>Password
            </label>
            <input
                id="password"
                name="password"
                type="password"
                autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl form-input @if($regErrors->has('password')) input-error @endif"
                placeholder="Create a strong password"
            >
            <p class="text-xs text-gray-500 mt-1">
                <i class="fas fa-info-circle mr-1"></i>Minimum 8 characters, with uppercase and number
            </p>
            @error('password', 'register')
                <p class="error-message">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-lock mr-2 text-blue-500"></i>Confirm Password
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl form-input @if($regErrors->has('password')) input-error @endif"
                placeholder="Confirm your password"
            >
        </div>


        <button type="submit" class="w-full py-3 px-4 rounded-xl text-white font-semibold btn-primary">
            <i class="fas fa-user-plus mr-2"></i>Create Account
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">Or continue with</span>
        </div>
    </div>

    <!-- Social Login Buttons (placeholders) -->
    <div class="grid grid-cols-2 gap-3">
        <button class="social-btn flex items-center justify-center py-3 px-4 bg-white rounded-xl text-gray-700 font-medium" type="button">
            <i class="fab fa-google text-red-500 mr-2"></i>
            Google
        </button>
        <button class="social-btn flex items-center justify-center py-3 px-4 bg-white rounded-xl text-gray-700 font-medium" type="button">
            <i class="fab fa-facebook text-blue-600 mr-2"></i>
            Facebook
        </button>
    </div>

    <!-- Footer Section with Image -->
    <div class="mt-8 text-center">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/fd880e3d-174f-4b3f-8880-b838396ce4f1.png" alt="Modern blogging platform" class="w-full rounded-lg mx-auto shadow-md">
        <p class="text-sm text-gray-600 mt-3">
            <i class="fas fa-rocket text-blue-500 mr-1"></i>
            Start your blogging journey today
        </p>
    </div>
</div>

<script>
    // Tabs
    const loginTab = document.getElementById('loginTab');
    const signupTab = document.getElementById('signupTab');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    function setActive(tab) {
        if (tab === 'signup') {
            signupForm.classList.remove('hidden');
            loginForm.classList.add('hidden');
            signupTab.classList.add('tab-active');
            loginTab.classList.remove('tab-active');
        } else {
            loginForm.classList.remove('hidden');
            signupForm.classList.add('hidden');
            loginTab.classList.add('tab-active');
            signupTab.classList.remove('tab-active');
        }
    }

    loginTab.addEventListener('click', () => setActive('login'));
    signupTab.addEventListener('click', () => setActive('signup'));

    // Default active tab from server (login or signup)
    const serverTab = @json(session('activeTab', $activeTab ?? 'login'));
    setActive(serverTab);

    document.getElementById("username").addEventListener("input", function() {
    let username = this.value.trim();
    let errorMsg = document.getElementById("usernameError");

    if (username.length < 5) {
        errorMsg.innerText = "Username must be at least 5 characters.";
    } else {
        errorMsg.innerText = "";
    }
});

</script>
</body>
</html>
