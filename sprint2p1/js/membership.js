function showMembershipPlanOptions(){
    if (document.getElementById('membership_plan_options').style.display == 'block'){
        document.getElementById('membership_plan_options').style.display='none';
    } else {
        document.getElementById('membership_plan_options').style.display='block';
        document.getElementById('membership_plan_options').scrollIntoView();
    }
}


if(document.getElementById('daily').checked == true){
    document.getElementsByClassName('membership_plan_option')[0].style.backgroundColor='rgb(140, 140, 140)';
    document.getElementsByClassName('membership_plan_option')[0].style.borderColor='rgb(140, 140, 140)';
    document.getElementsByClassName('membership_plan_option')[0].style.color='white';
}

const radios = document.querySelectorAll('input[type="radio"]');
for (const radio of radios) {
    radio.onclick = (e) => {
        if(document.getElementById('daily').checked == true){
            document.getElementsByClassName('membership_plan_option')[0].style.backgroundColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[0].style.borderColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[0].style.color='white';
        } else {
            document.getElementsByClassName('membership_plan_option')[0].style.backgroundColor='white';
            document.getElementsByClassName('membership_plan_option')[0].style.borderColor='black';
            document.getElementsByClassName('membership_plan_option')[0].style.color='black';
        }
        

        if(document.getElementById('monthly').checked == true){
            document.getElementsByClassName('membership_plan_option')[1].style.backgroundColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[1].style.borderColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[1].style.color='white';
        } else {
            document.getElementsByClassName('membership_plan_option')[1].style.backgroundColor='white';
            document.getElementsByClassName('membership_plan_option')[1].style.borderColor='black';
            document.getElementsByClassName('membership_plan_option')[1].style.color='black';
        }
        
        if(document.getElementById('biannually').checked == true){
            document.getElementsByClassName('membership_plan_option')[2].style.backgroundColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[2].style.borderColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[2].style.color='white';
        } else {
            document.getElementsByClassName('membership_plan_option')[2].style.backgroundColor='white';
            document.getElementsByClassName('membership_plan_option')[2].style.borderColor='black';
            document.getElementsByClassName('membership_plan_option')[2].style.color='black';
        }
        
        if(document.getElementById('yearly').checked == true){
            document.getElementsByClassName('membership_plan_option')[3].style.backgroundColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[3].style.borderColor='rgb(140, 140, 140)';
            document.getElementsByClassName('membership_plan_option')[3].style.color='white';
        } else {
            document.getElementsByClassName('membership_plan_option')[3].style.backgroundColor='white';
            document.getElementsByClassName('membership_plan_option')[3].style.borderColor='black';
            document.getElementsByClassName('membership_plan_option')[3].style.color='black';
        }
    }
}