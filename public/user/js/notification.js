function showNotification(from, align, type ,message){

    var icons;

    if (type == 'success'){
        icons = 'check';
    } else if(type == 'danger'){
        icons = 'error_outline';
    } else if (type == 'warning'){
        icons = 'warning_amber';
    }

  $.notify({
      icon: icons,
      message: message

  },{
      type: type,
      timer: 4000,
      placement: {
          from: from,
          align: align
      }
  });
}