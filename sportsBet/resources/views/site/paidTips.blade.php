@extends('site.home')

@section('paid_tips')
<!--- Premium Tips -->
<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
    @if($subscription_is_active)
        <!--  table -->
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
            <h4 class="sec-head ">Premium Tips</h4>
            <table class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Match</th>
                        <th>Market</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paidMatches as $paidMatch)
                    <tr>
                        <td>{{ $paidMatch->match_date }}</td>
                        <td>{{ $paidMatch->game }}</td>
                        <td>{{ $paidMatch->odd_type }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End  table -->

        <!-- Supersingles table -->
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
            <h4 class="sec-head ">Supersingle Tips</h4>
            <table id="premium-supersingles-table" class="table table-responsive table-striped">
                <thead>
                    <tr role="row">
                        <th>Date</th>
                        <th>Game</th>
                        <th>Market</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supersingleMatches as $match)
                    <tr>
                        <td class="">{{ $match->match_date }}</td>
                        <td class="">{{ $match->game }}</td>
                        <td class="">{{ $match->odd_type }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End Supersingles table -->

        <!-- Multibets table -->
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
            <h4 class="sec-head ">Multibet Tips</h4>
            <div class="bg-info info-discalaimer">
                <p>
                    If going with our multibets, please avoid mixing games from each multibet. For example
                    If you pick <strong>multibet #1</strong> don't include games from <strong>multibet #2</strong>.
                </p>
            </div>
            <table id="premium-multibets-table" class="table table-responsive table-striped">
                <thead>
                    <tr role="row">
                        <th>Multibet Name</th>
                        <th>Date</th>
                        <th>Game</th>
                        <th>Market</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- append datatable -->
                </tbody>
            </table>
        </div>
        <!-- End Multibets table -->

        <!-- Maxstake table -->
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="margin-top: 50px;">
            <h4 class="sec-head ">Maxstake Tips</h4>
            <div class="bg-info info-discalaimer">
                <p>
                    If going with our maxstake matches, please avoid mixing games from each maxstake. For example
                    If you pick <strong>maxstake #1</strong> don't include games from <strong>maxstake #2</strong>.
                </p>
            </div>
            <table id="premium-maxstake-table" class="table table-responsive table-striped">
                <thead>
                    <tr>
                        <th>Maxstake Name</th>
                        <th>Date</th>
                        <th>Game</th>
                        <th>Market</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- append datatable -->
                </tbody>
            </table>
        </div>
        <!-- End Maxstake table -->

    @else
        <div class="p-3 mb-2 bg-warning text-center" style="padding-top: 20px; padding-bottom: 20px;">
            <h4>Your subscription has expired :( </h4>
        </div>
    @endif
</div>
<!-- End Premium Tips -->
@endsection


@section('paid_tips_javascript')
<script type="text/javascript">

    $(document).ready(function () {

        let multibetUrl = "{{ route('multibets') }}";
        let maxstakeUrl = "{{ route('maxstakes') }}";

        drawTable('#premium-multibets-table',multibetUrl, 'multibetName');
        drawTable('#premium-maxstake-table',maxstakeUrl, 'maxstakeName');
    });

    function drawTable(table_id, url, dataSrcName)
    {
        $(table_id).DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            order: [[0, 'asc']], 
            rowGroup: {
                dataSrc: dataSrcName
            },
            scrollY:"400px",
            scrollCollapse: true,
            searching: false, 
            paging: false, 
            columns: [
                {
                    data:dataSrcName,
                    name:dataSrcName,
                    visible:false,
                },
                {
                    data:'match_date',
                    name:'match_date',
                    orderable: false,
                },
                {
                    data:'game',
                    name:'game',
                    orderable: false,
                },
                {
                    data:'odd_type',
                    name:'odd_type',
                    orderable: false,
                }
            ]
        });
    }
</script>
@endsection
