const authTitle = document.getElementById('authTitle');
const authDescription = document.getElementById('authDescription');
const authForm = document.getElementById('authForm');
const nameField = document.getElementById('nameField');
const authToggleText = document.getElementById('authToggleText');
const authToggle = document.getElementById('authToggle');
const submitButton = authForm.querySelector('button[type="submit"]');
const googleButton = document.querySelector('button[type="button"]');

let isSignUp = false;

function toggleAuthMode() {
    isSignUp = !isSignUp;
    
    authTitle.textContent = isSignUp ? 'Sign Up' : 'Sign In';
    authDescription.textContent = isSignUp
        ? 'Create a new account to get started'
        : 'Sign in to your account to continue';
    
    nameField.classList.toggle('hidden');
    
    submitButton.textContent = isSignUp ? 'Sign Up' : 'Sign In';
    
    authToggleText.textContent = isSignUp ? 'Already have an account?' : "Don't have an account?";
    authToggle.textContent = isSignUp ? 'Sign In' : 'Sign Up';

    googleButton.textContent = isSignUp ? 'Sign up with Google' : 'Sign in with Google';
}

authToggle.addEventListener('click', toggleAuthMode);

authForm.addEventListener('submit', (e) => {
    e.preventDefault();
    // Here you would typically send the form data to your server
    console.log('Form submitted:', isSignUp ? 'Sign Up' : 'Sign In');
    // You can access form data using FormData API
    const formData = new FormData(authForm);
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }
});

googleButton.addEventListener('click', () => {
    // Here you would typically initiate Google OAuth flow
    console.log('Google authentication clicked');
});