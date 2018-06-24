@extends('layout.app')
@section('styles')
  <link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('css/fullcalendar.print.min.css')}}"> --}}
@endsection

@section('content')
  <div class="container">
    <div class="row" style="font-size:32px;">
      <span class="mr-auto " >
        <a id="my-prev-button" ><i class="fa fa-arrow-circle-left"></i></a>
      </span>
      <span class="ml-auto">
        <a id="my-next-button" ><i class="fa fa-arrow-circle-right"></i></a>
      </span>
    </div>
        <div id='calendar'></div>
    </div>

  </div>

@endsection
@section('scripts')
  <script src="js/moment.min.js" charset="utf-8"></script>
  <script src="js/fullcalendar.min.js" charset="utf-8"></script>

  <script type="text/javascript">
    $( document ).ready(function() {

      $('#calendar').fullCalendar({
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',

        header: { center: 'month,agendaWeek,timelineFourDays' },
        views: {
          month: { // name of view
            titleFormat: 'DD MM YYYY'
            // other view-specific options here
          },
          timelineFourDays: {
            type: 'timeline',
            duration: { days: 4 }
        }
      },
      eventSources:[
        {
          events: [
          {
            title  : 'event1',
            start  : '2018-06-24'
          },
          {
            title  : 'event2',
            start  : '2018-06-24'
          },
          {
            start  : '2018-06-24',
            allDay : true // will make the time show
          }
        ],
        color: 'red',   // an option!
        textColor: 'white' // an option!
      },
      {
        events: [
        {
          title  : 'event1',
          start  : '2018-06-25',
          end    : '2018-06-28',
        },
        {
          title  : 'event2',
          start  : '2018-06-25'
        },
        {
          start  : '2018-06-25',
          allDay : false // will make the time show
        }
      ],
      color: 'blue',   // an option!
      textColor: 'white' // an option!
      }


      ]

      });

      $('#my-prev-button').click(function() {
        $('#calendar').fullCalendar('prev');
      });
      $('#my-next-button').click(function() {
        $('#calendar').fullCalendar('next');
      });


    });
  </script>
@endsection
