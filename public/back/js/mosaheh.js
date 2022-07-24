/*function addQNToList(event){
    event.preventDefault();
}*/

function toggleQTypeSelectAction()
{
    if(document.getElementById('rdoAll').checked===true )
    {
        //alert(1);
        document.getElementById('txtQN').disabled =true;
        document.getElementById('btnAddQNToList').disabled =true;
        document.getElementById('lstQN').disabled =true;
        document.getElementById('btnRemoveQN').disabled =true;

        document.getElementById('btnAddQNToList').classList.add("btnDefaultDisable");
        document.getElementById('btnRemoveQN').classList.add("btnDefaultDisable");
    }
    else  if(document.getElementById('rdoSel').checked===true)
    {
        //alert(2);
        document.getElementById('txtQN').disabled =false;
        document.getElementById('btnAddQNToList').disabled =false;
        document.getElementById('lstQN').disabled =false;
        document.getElementById('btnRemoveQN').disabled =false;

        document.getElementById('btnAddQNToList').classList.remove("btnDefaultDisable");
        document.getElementById('btnRemoveQN').classList.remove("btnDefaultDisable");
    }
    else
        alert('خطا کد 21');
}

function setQNTohiddenValue(){
    var strQNumbers='';
    for (let i = 0; i < sb.options.length; i++) {
        strQNumbers += sb.options[i].value+'_';
    }

    document.querySelector('#hidQNumbers').value = strQNumbers;
    //alert(strQNumbers);
}

const btnAdd = document.querySelector('#btnAddQNToList');
const btnRemove = document.querySelector('#btnRemoveQN');
const sb = document.querySelector('#lstQN');
const name = document.querySelector('#txtQN');
const chkLessonQNAssign = document.querySelector('#chk_LessonQNAssign');

chkLessonQNAssign.onchange = (e)=>{lessonAssignToggle()}

function lessonAssignToggle(){
    if(chkLessonQNAssign.checked===true)
    {
        document.getElementById('cmbLessonID').disabled =false;
        document.getElementById('rdoAll').disabled =false;
        document.getElementById('rdoSel').disabled =false;
        document.getElementById('txtDorehInfo').classList.remove("txtDefaultDisable");


        toggleQTypeSelectAction();

    }
    else
    {
        document.getElementById('cmbLessonID').disabled =true;
        document.getElementById('rdoAll').disabled =true;
        document.getElementById('rdoSel').disabled =true;
        document.getElementById('txtDorehInfo').classList.add("txtDefaultDisable");


        document.getElementById('txtQN').disabled =true;
        document.getElementById('btnAddQNToList').disabled =true;
        document.getElementById('lstQN').disabled =true;
        document.getElementById('btnRemoveQN').disabled =true;

        document.getElementById('btnAddQNToList').classList.add("btnDefaultDisable");
        document.getElementById('btnRemoveQN').classList.add("btnDefaultDisable");
    }
}

btnAdd.onclick = (e) => {
    e.preventDefault();

    // validate the option
    if (name.value == '' || isNaN(name.value) || (name.value<1) ) {
        alert('مقدار وارد شده نامعتبر است');
        return;
    }
    // create a new option
    const option = new Option(name.value, name.value);
    // add it to the list
    sb.add(option, undefined);
    // reset the value of the input
    name.value = '';
    name.focus();

    setQNTohiddenValue();
};

// remove selected option
btnRemove.onclick = (e) => {
    e.preventDefault();

    // save the selected option
    let selected = [];

    for (let i = 0; i < sb.options.length; i++) {
        selected[i] = sb.options[i].selected;
    }

    // remove all selected option
    let index = sb.options.length;
    while (index--) {
        if (selected[index]) {
            sb.remove(index);
        }
    }

    setQNTohiddenValue();
};

//window.onload = lessonAssignToggle();
document.addEventListener('DOMContentLoaded', function() {
    lessonAssignToggle()
}, false);
