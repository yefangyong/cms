//选择头像
function sface() {
    var fm = document.reg;
    var index = fm.face.selectedIndex;//获得索引
    fm.faceing.src = 'images/'+fm.face.options[index].value;//获得值
}

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
    if(fm.code.value.length!=4) {
        alert('警告：验证码必须为4位!');
        fm.code.focus();
        return false;
    }
    return true;
}

function checkLog() {
    var fm=document.login;
    if(fm.user.value == '' || fm.user.value.length <2 || fm.user.value.length>20) {
        alert('警告：用户名不得为空并且不得小于两位并且不得大于8位');
        fm.user.focus();
        return false;
    }

    if(fm.code.value.length!=4) {
        alert('警告：验证码必须为4位!');
        fm.code.focus();
        return false;
    }

    if (fm.pass.value == '' || fm.pass.value.length < 6 ) {
        alert('警告：密码不得为空并且不得小于六位！');
        fm.pass.focus();
        return false;
    }
    return true;

}