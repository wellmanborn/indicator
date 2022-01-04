{{--
@if(auth()->user()->notifications->count() > 0)
    <li class="dropdown  hidden-xs">
        <a onclick="markNotificationsAsRead()" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-bell"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="badge">{{ auth()->user()->unreadNotifications->count() }}</span>
            @endif
        </a>
        <ul class="dropdown-menu dropdown-lg">
            <li><a>{{ __("Notifications") }} ({{ auth()->user()->notifications->count() }})</a></li>
            @foreach(auth()->user()->notifications()->take(5)->get() as $notification)
                <li class="clearfix"><a href="#">
                        <i class="fa fa-bell"></i> <div class="drop-content">
                            <h4>{{ __($notification->data["message"]) }}</h4>
                            <span>{{ __($notification->data["message"]) }}</span>
                        </div></a>
                </li>
            @endforeach
            @if(auth()->user()->notifications->count() > 5)
                <li><a href="#" class="text-center">{{ __("View All Notifications") }}</a></li>
            @endif
        </ul>
    </li>
@endif
--}}

{{--@push("scripts")
    <script>
        function markNotificationsAsRead(){
            $.ajax({
                url: "{{ route("notification.mark_as_read") }}",
                success: function(){}
            })
        }
    </script>
@endpush--}}
