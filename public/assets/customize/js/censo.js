function __datetimepicker(value) {
    $("#" + value).datetimepicker({
      buttons: {
        showToday: true,
        showClear: true,
      },
      // Posición del Date
      widgetPositioning: {
        vertical: "bottom",
      },
      icons: {
        time: "far fa-clock",
        clear: "far fa-trash-alt",
        today: "far fa-calendar-check",
      },
      locate: "es",
      tooltips: {
        today: "Hoy",
        clear: "Limpiar",
        close: "Cerrar",
        selectMonth: "Seleccione Mes",
        prevMonth: "Mes anterior",
        nextMonth: "Mes siguiente",
        selectYear: "Seleccione Año",
        prevYear: "Año Anterior ",
        nextYear: "Año Siguiente",
        selectDecade: "Seleccione Decada",
        prevDecade: "Decada Anterior",
        nextDecade: "Decada Siguiente",
        prevCentury: "Siglo Anterior",
        nextCentury: "Siglo Siguiente",
        selectTime: "Seleccione Tiempo",
        selectDate: "Seleccione Fecha",
      },
  
      // toma el día de hoy y no para atrás
      // minDate: new Date() - 2,
      // Formato predefinido
      format: "L",
      //Deshabilita sábado y domingos
      // daysOfWeekDisabled: [0, 6],
    });
  }
  
  function __datetimepicker_time(value) {
    $("#" + value).datetimepicker({
      buttons: {
        showToday: true,
        showClear: true,
      },
      // Posición del Date
      widgetPositioning: {
        vertical: "bottom",
      },
      icons: {
        time: "far fa-clock",
        clear: "far fa-trash-alt",
        today: "far fa-calendar-check",
      },
      locate: "es",
      tooltips: {
        today: "Hoy",
        clear: "Limpiar",
        close: "Cerrar",
        selectMonth: "Seleccione Mes",
        prevMonth: "Mes anterior",
        nextMonth: "Mes siguiente",
        selectYear: "Seleccione Año",
        prevYear: "Año Anterior ",
        nextYear: "Año Siguiente",
        selectDecade: "Seleccione Decada",
        prevDecade: "Decada Anterior",
        nextDecade: "Decada Siguiente",
        prevCentury: "Siglo Anterior",
        nextCentury: "Siglo Siguiente",
        selectTime: "Seleccione Tiempo",
        selectDate: "Seleccione Fecha",
      },
  
      // toma el día de hoy y no para atrás
      // minDate: new Date() - 2,
      maxDate: new Date(),
      // Formato predefinido
      format: "DD/MM/YYYY HH:mm:ss",
      //Deshabilita sábado y domingos
      // daysOfWeekDisabled: [0, 6],
    });
  }
  
  function __datepicker(value) {
    $("#" + value).datetimepicker({
      buttons: {
        showToday: true,
        showClear: true,
      },
      // Posición del Date
      widgetPositioning: {
        vertical: "bottom",
      },
      icons: {
        time: "far fa-clock",
        clear: "far fa-trash-alt",
        // today: "far fa-calendar-check",
      },
      locate: "es",
      tooltips: {
        today: "Hoy",
        clear: "Limpiar",
        close: "Cerrar",
        selectMonth: "Seleccione Mes",
        prevMonth: "Mes anterior",
        nextMonth: "Mes siguiente",
        selectYear: "Seleccione Año",
        prevYear: "Año Anterior ",
        nextYear: "Año Siguiente",
        selectDecade: "Seleccione Decada",
        prevDecade: "Decada Anterior",
        nextDecade: "Decada Siguiente",
        prevCentury: "Siglo Anterior",
        nextCentury: "Siglo Siguiente",
        selectTime: "Seleccione Tiempo",
        selectDate: "Seleccione Fecha",
      },
  
      // toma el día de hoy y no para atrás
      // minDate: new Date() - 2,
      maxDate: new Date(),
      // Formato predefinido
      format: "DD/MM/YYYY",
      //Deshabilita sábado y domingos
      // daysOfWeekDisabled: [0, 6],
    });
    
  }
  
  function __inputmask(value, format) {
    $("#" + value).inputmask(format, {
      placeholder: format,
    });
  }
  