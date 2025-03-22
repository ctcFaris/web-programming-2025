$("#contactForm").validate({
    rules: {
        message: {
            required: true,
            minLength: 5
        },
        name:  {
            required: true,
            minLength: 5
        },
        email:  {
            required: true,
            email: true
        },
        subject: {
            required: true,
            minlength: 4
        },
    }
});