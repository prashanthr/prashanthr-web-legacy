  

  

function showReclaimManaDialog() {
 var manaOpt = {
  title: "Reclaim Mana",
  autoOpen: false,
  closeOnEscape: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      modal: true,
      buttons: {
        "Reclaim": function() {
          updateMana($('#manabar-slider').slider("option", "value"));
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }    
    }
  }

var manabarElement = $( "#manabar" );
var currentValue = manabarElement.progressbar( "value" );

var progressBarOpt = {
  range: "max",
      min: 10,
      max: 100,
      step: 10,
      value: currentValue,
      slide: function( event, ui ) {
        $( "#manabar-reset-amount" ).val( ui.value );
      }
}

// $( "#dialog-manabar-reclaim" ).dialog({
//       autoOpen: false,
//       show: {
//         effect: "blind",
//         duration: 1000
//       },
//       hide: {
//         effect: "explode",
//         duration: 1000
//       }
//     });
$( "#manabar-reset-amount" ).val( $( "#manabar-slider" ).slider(progressBarOpt).slider( "value" ) );
 // $( "#manabar-slider" ).slider();
  $( "#dialog-manabar-reclaim" ).dialog(manaOpt).dialog( "open" );  
}

function showBasicDialog(elementIdentifierWithPrefix) {
  $(function() {
    $( elementIdentifierWithPrefix ).dialog();
  });
}

function showNotesDialog (notes) {
  var notesOpt = {
  title: "Note",
  autoOpen: false,
  closeOnEscape: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      modal: true  
    }

document.getElementById("noteDialogDiv").innerHTML = notes;
$("#noteDialogDiv").dialog(notesOpt).dialog("open")

}

function showBasicDialogWithOptions(elementIdentifierWithPrefix, height, modal) {
  $(function() {
    $( elementIdentifierWithPrefix ).dialog({
      height: height,
      modal: modal
    });
  });
}

function showTimedBreakPromptDialog()
{
  var timedBreakOpt = {
  title: "Timed Break",
  autoOpen: false,
  closeOnEscape: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      modal: true,      
      buttons: {
        "Set": function() {         
          $( this ).dialog( "close" );
          timedBreakCallback(true, document.getElementById('timed-break-input').value);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
          timedBreakCallback(false, -1);
        }    
    }
  }

  $("#dialog-timed-break").dialog(timedBreakOpt).dialog("open");
}

function showTimedBreakPromptKnobDialog()
{
    var timedBreakOpt = {
  title: "Timed Break",
  width: 475,
  autoOpen: false,
  closeOnEscape: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      },
      modal: true,      
      buttons: {
        "Set": function() {         
          $( this ).dialog( "close" );
          timedBreakCallback(true, document.getElementById('timed-break-input').value);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
          timedBreakCallback(false, -1);
        }    
    }
  }

  $(".dial-hour").knob({
                'min':0
                ,'max':12
                });

  $(".dial-min").knob({
                'min':0,
                'max':59,
                'fgColor': 'red'
                });

   $("#dialog-timed-break-knob").dialog(timedBreakOpt).dialog("open");
}