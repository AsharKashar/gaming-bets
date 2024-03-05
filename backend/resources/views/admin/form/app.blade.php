<div id="vue-app">
    <v-app id="root">
        @foreach ($components as $component)
            <{{ $component  }} :data="{{ json_encode($data??[]) }}"></{{$component}}>
        @endforeach
    </v-app>
</div>
