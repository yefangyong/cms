window.onload = function () {
    var title = document.getElementById('title');
    var ol = document.getElementsByTagName('ol');
    var a = ol[0].getElementsByTagName('a');

    for (i=0;i<a.length;i++) {
        a[i].className = null;
        if (title.innerHTML == a[i].innerHTML) {
            a[i].className = 'selected';
        }
    }
};

//验证登录
function checkReg() {
    var fm = document.reg;
    if (fm.user.value == '' || fm.user.value.length < 2 || fm.user.value.length > 8) {
        alert('警告：用户名不得为空并且不得小于两位并且不得大于8位！');
        fm.user.focus();
        return false;
    }
    if (fm.pass.value == '' || fm.pass.value.length < 6 ) {
        alert('警告：密码不得为空并且不得小于六位！');
        fm.pass.focus();
        return false;
    }
    if(fm.pass.value != fm.notpass.value) {
        alert('警告：密码不一致!');
        fm.notpass.focus();
        return false;
    }
    if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
        alert('邮件格式不正确');
        fm.email.value = ''; //清空
        fm.email.focus(); //将焦点以至表单字段
        return false;
    }
    return true;
}

//选择头像
function sface() {
    var fm = document.reg;
    var index = fm.face.selectedIndex;
    fm.faceimg.src = '../images/'+fm.face.options[index].value;
}
function checkForm() {
    var fm = document.add;
    if (fm.nav_name.value == '' || fm.nav_name.value.length < 2 || fm.nav_name.value.length > 20) {
        alert('警告：导航名称不得为空并且不得小于两位并且不得大于20位！');
        fm.nav_name.focus();
        return false;
    }
    if (fm.nav_info.value.length > 200) {
        alert('警告：导航描述不得大于200位！');
        fm.nav_info.focus();
        return false;
    }
    return true;
}