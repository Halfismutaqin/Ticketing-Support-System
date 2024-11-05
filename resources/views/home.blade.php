@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-3">
                                    <div class="text-value">{{ number_format($totalTickets) }}</div>
                                    <div><b>Total All Tickets</b></div>
                                    <br />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-3">
                                    <div class="text-value">{{ number_format($ticketThisMonth) }}</div>
                                    <div><b>Tickets This Month</b></div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card text-white bg-danger">
                                <div class="card-body pb-3">
                                    <div class="text-value">{{ number_format($newTickets) }}</div>
                                    <div><b>New Tickets</b></div>
                                    <br />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-white bg-primary">
                                <div class="card-body pb-3">
                                    <div class="text-value">{{ number_format($openTickets) }}</div>
                                    <div><b>Open Tickets</b></div>
                                    <br />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-white bg-warning">
                                <div class="card-body pb-3">
                                    <div class="text-value">{{ number_format($pendingTickets) }}</div>
                                    <div><b>Pending/Hold Tickets</b></div>
                                    <br />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card text-white bg-success">
                                <div class="card-body pb-3">
                                    <div class="text-value">{{ number_format($closedTickets) }}</div>
                                    <div><b>Closed Tickets</b></div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection