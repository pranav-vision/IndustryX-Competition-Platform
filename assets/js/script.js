// ======================================
// IndustryX JavaScript
// ======================================

console.log("IndustryX Loaded Successfully");

// ======================================
// Auto Hide Bootstrap Alerts
// ======================================

document.addEventListener("DOMContentLoaded", function () {

    const alerts = document.querySelectorAll(".alert");

    alerts.forEach(function(alert){

        setTimeout(function(){

            alert.style.transition = "0.5s";
            alert.style.opacity = "0";

            setTimeout(function(){

                alert.remove();

            },500);

        },4000);

    });

});

// ======================================
// Delete Confirmation
// ======================================

function confirmDelete(message="Are you sure you want to delete?")
{
    return confirm(message);
}

// ======================================
// Form Validation
// ======================================

document.addEventListener("DOMContentLoaded", function(){

    const forms = document.querySelectorAll("form");

    forms.forEach(function(form){

        form.addEventListener("submit", function(e){

            const required = form.querySelectorAll("[required]");

            for(let input of required)
            {
                if(input.value.trim()==="")
                {
                    alert("Please fill all required fields.");

                    input.focus();

                    e.preventDefault();

                    return;
                }
            }

        });

    });

});

// ======================================
// Loading Button
// ======================================

document.addEventListener("DOMContentLoaded", function(){

    const buttons = document.querySelectorAll("button[type='submit']");

    buttons.forEach(function(btn){

        btn.addEventListener("click", function(){

            btn.disabled = true;

            btn.innerHTML = "Please Wait...";

            btn.form.submit();

        });

    });

});

// ======================================
// Future Image Preview
// ======================================

function previewImage(input, previewId)
{
    if(input.files && input.files[0])
    {
        const reader = new FileReader();

        reader.onload = function(e){

            document.getElementById(previewId).src = e.target.result;

        };

        reader.readAsDataURL(input.files[0]);
    }
}