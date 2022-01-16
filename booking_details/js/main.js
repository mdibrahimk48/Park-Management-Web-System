     	$(document).ready(function() {
		$('#bookingDate').datepicker({format:'YYYY-MM-DD'});
                
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
				
			//defaultDate: '2017-04-12',
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
		
                                $('#bookingDate').datepicker('set', start);
				$('#calendar').fullCalendar('unselect');
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			
		});
         
		
	});
        
        function selectPartyId(id){
            $("#pid").val(id);
        }

