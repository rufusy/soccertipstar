@extends('site.home')

@section('free_tips')
<!--- Free Tips -->
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <h4 class="sec-head ">Free Tips</h4>
    <table class="table table-responsive table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th class="">Match</th>
                <th class="">Market</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($freeMatches as $freeMatch)
            <tr>
                <td>{{ $freeMatch->match_date }}</td>
                <td>{{ $freeMatch->game }}</td>
                <td>{{ $freeMatch->odd_type }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- End Free Tips -->
@endsection
