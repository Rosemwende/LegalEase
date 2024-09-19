document.addEventListener('DOMContentLoaded', function () {
    const reportForm = document.getElementById('reportForm');
    const reportMessage = document.getElementById('reportMessage');

    reportForm.addEventListener('submit', function (e) {
        e.preventDefault();
        
        const formData = new FormData(reportForm);
        const reportType = formData.get('reportType');

        fetch('generate_report.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.blob();
            } else {
                throw new Error('Report generation failed');
            }
        })
        .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = reportType === 'pdf' ? 'report.pdf' : 'report.csv';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            reportMessage.textContent = 'Report generated successfully';
            reportMessage.style.color = 'green';
        })
        .catch(error => {
            reportMessage.textContent = error.message;
            reportMessage.style.color = 'red';
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    var dropdownToggle = document.querySelectorAll('.custom-dropdown-toggle');

    dropdownToggle.forEach(function(toggle) {
        toggle.addEventListener('click', function(event) {
            event.preventDefault();
            var menu = this.nextElementSibling;
            if (menu.style.display === "block") {
                menu.style.display = "none";
            } else {
                menu.style.display = "block";
            }
        });
    });
});

//add functionality to handle dropdown menu clicks if needed

document.addEventListener('DOMContentLoaded', function() {
    // Example: Close dropdown menu when clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(dropdown => {
            if (!dropdown.contains(event.target) && !event.target.matches('.dropdown a')) {
                dropdown.style.display = 'none';
            }
        });
    });
});
// Custom JavaScript for form validation

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('validateForm');
    
    form.addEventListener('submit', function (event) {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var valid = true;

        // Clear previous errors
        var errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(function (message) {
            message.remove();
        });

        // Validate email
        if (email === '') {
            showError('email', 'Please Enter your email address');
            valid = false;
        } else if (!validateEmail(email)) {
            showError('email', 'Please Enter a valid email address');
            valid = false;
        }

        // Validate password
        if (password === '') {
            showError('password', 'Please Enter Your Password');
            valid = false;
        }

        if (!valid) {
            event.preventDefault();
        }
    });

    function showError(inputId, message) {
        var input = document.getElementById(inputId);
        var errorDiv = document.createElement('div');
        errorDiv.classList.add('error-message');
        errorDiv.innerText = message;
        input.parentNode.appendChild(errorDiv);
    }

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re

    //clientregisterform
document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('validateForm');

    form.addEventListener('submit', function(event) {
        let isValid = true;
        const fields = [
            'first_Name',
            'last_Name',
            'email',
            'contact_number',
            'full_address',
            'city',
            'zip_code'
        ];

        fields.forEach(function(field) {
            const input = document.getElementById(field);
            if (input && input.value.trim() === '') {
                isValid = false;
                input.style.border = "1px solid red";
            } else if (input) {
                input.style.border = "";
            }
        });

        const agreeCheckbox = document.getElementById('accept');
        if (!agreeCheckbox.checked) {
            isValid = false;
            agreeCheckbox.style.outline = "1px solid red";
        } else {
            agreeCheckbox.style.outline = "";
        }

        if (!isValid) {
            event.preventDefault();
            alert('Please fill out all fields and agree to the terms and conditions.');
        }
    });
});


//lawyerregisterform
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('validateForm');
    
    form.addEventListener('submit', function (event) {
        let isValid = true;
        let errorMessage = "Please fill out all required fields:\n";

        const first_Name = document.getElementById('first_Name').value.trim();
        const last_Name = document.getElementById('lname').value.trim();
        const contact_number = document.getElementById('contact_number').value.trim();
        const email = document.getElementById('email').value.trim();
        const university_College = document.getElementById('institute').value.trim();
        const degree = document.getElementById('degree').value.trim();
        const passing_year = document.getElementById('passing_year').value.trim();
        const full_address = document.getElementById('address').value.trim();
        const city = document.getElementById('city').value.trim();
        const zip_code = document.getElementById('zip').value.trim();
        const practise_Length = document.getElementById('practise').value.trim();
        const speciality = document.getElementById('speciality').value.trim();
        const agree = document.getElementById('accept').checked;

        if (!first_Name) {
            isValid = false;
            errorMessage += "- First Name\n";
        }
        if (!last_Name) {
            isValid = false;
            errorMessage += "- Last Name\n";
        }
        if (!contact_number) {
            isValid = false;
            errorMessage += "- Contact Number\n";
        }
        if (!email) {
            isValid = false;
            errorMessage += "- Email\n";
        }
        if (!university_College) {
            isValid = false;
            errorMessage += "- University / College Name\n";
        }
        if (!degree) {
            isValid = false;
            errorMessage += "- Degree\n";
        }
        if (!passing_year) {
            isValid = false;
            errorMessage += "- Passing Year\n";
        }
        if (!full_address) {
            isValid = false;
            errorMessage += "- Full Address\n";
        }
        if (!city) {
            isValid = false;
            errorMessage += "- City\n";
        }
        if (!zip_code) {
            isValid = false;
            errorMessage += "- Zip Code\n";
        }
        if (!practise_Length) {
            isValid = false;
            errorMessage += "- Length of Practice\n";
        }
        if (!speciality) {
            isValid = false;
            errorMessage += "- Speciality\n";
        }
        if (!agree) {
            isValid = false;
            errorMessage += "- You must agree to the terms and conditions\n";
        }

        if (!isValid) {
            alert(errorMessage);
            event.preventDefault();
        }
    });
});
</script>

//admin_dashboard
document.addEventListener('DOMContentLoaded', function () {
    fetchDataAndCreateCharts();
});

function fetchDataAndCreateCharts() {
    fetch('fetch_data.php')
        .then(response => response.json())
        .then(data => {
            console.log(data); // Add this line to check if data is being fetched correctly
            createChart('total', 'Roles Distribution', data.roles.labels, data.roles.values);
            // Repeat for other charts
        })
        .catch(error => console.error('Error fetching data:', error));
}

//admin lawyer
document.addEventListener('DOMContentLoaded', function() {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 3000);
    }
});

//images
function previewImage() {
    const file = document.getElementById('image').files[0];
    const preview = document.getElementById('imagePreview');
    
    const reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
        preview.style.display = 'block';
    };
    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
        preview.style.display = 'none';
    }
}
//Booking
document.addEventListener("DOMContentLoaded", function() {
    // Function to display a success message
    function showSuccessMessage() {
        swal({
            title: "Dear User...Booking Details Saved Successfully",
            text: "",
            icon: "success",
            button: "OK",
        }).then(() => {
            window.location = 'http://localhost/lawyermanagementsystem/index.php';
        });
    }

    // Check if there's a success message to show
    if (document.querySelector('input[name="post"]')) {
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            // Simulate form submission and show success message
            showSuccessMessage();
        });
    }
});

