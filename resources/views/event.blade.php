<!DOCTYPE html>
<html>
<head>
    <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Import boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    {{-- Kalender --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    {{-- Toast atau display message --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
</head>
<body>

<div class="container">
    <h1>Laravel 10 FullCalender Tutorial Example - ItSolutionStuff.com</h1>
    <div id='calendar'></div>
</div>

{{-- <script type="text/javascript">

    $(document).ready(function() {

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let calender = $('#calendar').fullCalendar({
            editable: true,
            events: '/event',
            displayEventTime:false,
            // editable:true,
            eventRender:function(event, element, view){
                if(event.allDay === "true"){
                    event.allDay = true
                }else{
                    event.allDay =false
                }
            },
            selectable:true,
            selectHelper:true,
            select:function(start,end,allday){
                var title = prompt('event')

                if(title){
                    let start = $.fullCalendar.formatDate(start, "Y-MM-DD")
                    let end = $.fullCalendar.formatDate(end, "Y-MM-DD")
                    $.ajax({
                        url:'/event',
                        data:{
                            title:title,
                            start:start,
                            end:end,
                            type:'add'
                        },
                        type:"POST",
                        success: function(data) {
                            displayMessage("Event Berhasil Dibuat")

                            calender.fullCalendar('renderEvent',
                            {
                                id: data.id,
                                title: title,
                                start: start,
                                end: end,
                                allDay: allDay
                            },true )

                            calender.fullCalendar('unselect');
                        }
                    });
                }
            },

            // eventDrop:function(event,delta){
            //     let start = $.fullCalendar.formatDate(start, "Y-MM-DD")
            //     let end = $.fullCalendar.formatDate(end, "Y-MM-DD")

            //     $.ajax({
            //         url:'/event',
            //         type:POST
            //         data:{
            //             title:event.title,
            //             start:start,
            //             end:end,
            //             id:event.id,
            //         },
            //         success:function(response){
            //             displayMessage('Update')
            //         }
            //     })
            // },


            eventClick: function(event) {
                let deleteMessage = confirm("Apa kamu yakin?")
                if(deleteMessage){
                    $.ajax({
                        type:"POST",
                        url:"/event",
                        data:{
                            id:event.id,
                            type: 'delete'
                        },
                        success:function(response){
                            calender.fullCalendar('remoceEvents', event.id)
                            displayMessage('Delete')
                        }
                    });
                }
            }


        });


    });

    function displayMessage(message) {
        toast.success(message,'Event')
    }
</script> --}}


<script type="text/javascript">
$(document).ready(function () {

    /*------------------------------------------
    --------------------------------------------
    Get Site URL
    --------------------------------------------
    --------------------------------------------*/
    var SITEURL = "{{ url('/') }}";

    /*------------------------------------------
    --------------------------------------------
    CSRF Token Setup
    --------------------------------------------
    --------------------------------------------*/
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*------------------------------------------
    --------------------------------------------
    FullCalender JS Code
    --------------------------------------------
    --------------------------------------------*/
    var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: SITEURL + "/event",
                    header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
                    displayEventTime: false,

                    editable: true,
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        var title = prompt('Event Title:');
                        if (title) {
                            var start = $.fullCalendar.formatDate(start, "HH:mm");
                            var end = $.fullCalendar.formatDate(end, "HH:mm");
                            $.ajax({
                                url:"/event",
                                data: {
                                    'title': title,
                                    'start': start,
                                    end: end,
                                    type: 'add'
                                },
                                type: "POST",
                                success: function (data) {
                                    displayMessage("Event Created Successfully");

                                    calendar.fullCalendar('renderEvent',
                                        {
                                            id: data.id,
                                            title: title,
                                            start: start,
                                            end: end,
                                            allDay: allDay
                                        },true);

                                    calendar.fullCalendar('unselect');
                                }
                            });
                        }
                    },
                    eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                        $.ajax({
                            url: SITEURL + '/event',
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Event Updated Successfully");
                            }
                        });
                    },
                    eventClick: function (event) {
                        var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: '/event',
                                data: {
                                        id: event.id,
                                        type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Acara Deleted Successfully");
                                }
                            });
                        }
                    }

                });

    });

    /*------------------------------------------
    --------------------------------------------
    Toastr Success Code
    --------------------------------------------
    --------------------------------------------*/
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }

</script>

</body>
</html>
