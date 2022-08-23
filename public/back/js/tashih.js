/*function addQNToList(event){
    event.preventDefault();
}*/


function setQNTohiddenValue(){
    var strQNumbers='';
    for (let i = 0; i < sb.options.length; i++) {
        strQNumbers += sb.options[i].value+'_';
    }

    document.querySelector('#hidMarkSection').value = strQNumbers;
    //alert(strQNumbers);
}

const btnAdd = document.querySelector('#btnAddQNToList');
const btnRemove = document.querySelector('#btnRemoveQN');
const sb = document.querySelector('#lstQN');
const name = document.querySelector('#txtQN');

btnAdd.onclick = (e) => {
    e.preventDefault();
    // validate the option
    if (name.value.trim() == '' ) {
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

function f1(){

    $("#markLogs").toggle();
    /*if ( display2 === true ) {
        $( "#txtToggle" ).Text('****');
    } else if ( display2 === false ) {
        $( "#txtToggle" ).Text('---');
    }*/
    if($('#markLogs').is(':visible'))
        $( "#txtToggle" ).html('- پنهان کردن');
    else
        $( "#txtToggle" ).html('+ مشاهده');
}

function showMarkLog(contentID){

    $("#markLogs_"+contentID).toggle();
    /*if ( display2 === true ) {
        $( "#txtToggle" ).Text('****');
    } else if ( display2 === false ) {
        $( "#txtToggle" ).Text('---');
    }*/
    if($('#markLogs_'+contentID).is(':visible'))
        $("#txtToggle_"+ contentID+"").html('- پنهان');
    else
        $("#txtToggle_"+ contentID ).html('+ مشاهده');
}
