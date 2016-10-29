window.onload = function() {
    var level = document.getElementById('level');
    var options = document.getElementsByTagName('option');
    if(level) {
        for(i=0;i<options.length;i++) {
            if(options[i].value == level.value) {
                options[i].setAttribute('selected','selected');
            }
        }

    }

};

function checkAddForm() {
    var fm = document.add;
    if(fm.admin_user.value == '' || fm.admin_user.value.length<2 ||fm.admin_user.value.length>20) {
        alert('用户名不得为空并且不得小于两位并且不得大于20位!');
        fm.admin_user.focus();
        return false;
    }
    if(fm.admin_pass.value == '' || fm.admin_pass.value.length<6) {
        alert('密码不得为空并且不得小于6位!');
        fm.admin_pass.focus();
        return false;
    }
    if(fm.admin_pass.value != fm.pass.value) {
        alert('密码和密码提示必须一致!');
        fm.admin_pass.focus();
        return false;
    }
    return true;
}

function checkUpdateForm() {
    var fm = document.update;
    if(fm.admin_pass.value != '') {
        if(fm.admin_pass.value.length<6) {
            alert('密码不得小于6位');
            fm.admin_pass.focus();
            return false;
        }
    }
    return true;
}