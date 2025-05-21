/**
 * Script to enhance the comment functionality for Portal Fakultas
 * - Adds animations to new comments
 * - Highlights admin replies that haven't been seen
 * - Tracks when users last checked their comments
 */
document.addEventListener('DOMContentLoaded', function() {
    // Track comment views for mahasiswa
    if (document.querySelector('.admin-reply')) {
        localStorage.setItem('lastCommentCheck', new Date().toISOString());
    }
    
    // Highlight new admin replies with animation
    const adminReplies = document.querySelectorAll('.admin-reply');
    adminReplies.forEach(reply => {
        const lastCheck = localStorage.getItem('lastCommentCheck');
        const replyDate = reply.getAttribute('data-timestamp');
        
        if (lastCheck && replyDate && new Date(replyDate) > new Date(lastCheck)) {
            reply.classList.add('new-reply');
        }
    });
    
    // Add animation to the notification badge in admin navbar
    const notificationBadge = document.querySelector('.badge-counter');
    if (notificationBadge && parseInt(notificationBadge.textContent) > 0) {
        notificationBadge.classList.add('badge-pulse');
    }
    
    // Track comment card interactions
    const commentCards = document.querySelectorAll('.comment-card');
    commentCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 0.5rem 1rem rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 0.125rem 0.25rem rgba(0, 0, 0, 0.075)';
        });
    });
});

// Additional utility functions for the comment system
function markCommentAsRead(commentId) {
    // This function would be used with AJAX to mark comments as read
    // Implementation would depend on the backend API
    console.log('Marking comment ' + commentId + ' as read');
}

function scrollToComment(commentId) {
    const comment = document.getElementById('comment-' + commentId);
    if (comment) {
        comment.scrollIntoView({ behavior: 'smooth', block: 'center' });
        comment.classList.add('highlight-comment');
        setTimeout(() => {
            comment.classList.remove('highlight-comment');
        }, 2000);
    }
}
