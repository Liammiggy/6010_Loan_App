// Toast notification system
window.Toast = {
    show: function(message, type = 'success', duration = 3000) {
        // Create toast element
        const toast = document.createElement('div');
        toast.innerHTML = `
            <x-alert-toast :type="'${type}'" :message="'${message}'" :duration="${duration}" />
        `;
        
        // Add to body
        document.body.appendChild(toast);
        
        // Remove after animation
        setTimeout(() => {
            toast.remove();
        }, duration + 300); // Add 300ms for animation
    },
    
    success: function(message, duration = 3000) {
        this.show(message, 'success', duration);
    },
    
    error: function(message, duration = 3000) {
        this.show(message, 'error', duration);
    },
    
    warning: function(message, duration = 3000) {
        this.show(message, 'warning', duration);
    },
    
    info: function(message, duration = 3000) {
        this.show(message, 'info', duration);
    }
};

// Handle server-side flash messages
document.addEventListener('DOMContentLoaded', function() {
    // Check for toast flash message
    const toastData = document.querySelector('meta[name="toast-data"]');
    if (toastData) {
        const data = JSON.parse(toastData.getAttribute('content'));
        if (data.type && data.message) {
            Toast[data.type](data.message);
        }
    }
}); 