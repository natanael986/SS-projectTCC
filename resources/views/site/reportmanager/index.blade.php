@extends('layouts.layout')

@section('content')
    <div class="Home_section">
        <div class="Home_header">
            <h2 class="mb-4">DENÚNCIA</h2>
        </div>


        <div class="container">

            <h2>POSTS DENÚNCIADOS</h2>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">User_ID</div>
                    <div class="col col-2">Palavra</div>
                    <div class="col col-3">Motivo</div>
                    <div class="col col-4"></div>
                </li>
                @foreach ($post_reports as $report)
                    @foreach ($posts as $post)
                        @if ($report->post_id == $post->id)
                            <form action="{{ route('reportmanager.destroy', $report->id) }}" method="POST">
                                <li class="table-row">
                                    <div class="col col-1" data-label="Job Id">{{ $post->name }} </div>
                                    <div class="col col-2" data-label="Customer Name">{{ $post->tittle }}</div>
                                    <div class="col col-3" data-label="Amount">{{ $report->reason }} </div>
                                    <div class="col col-4 ButtonFlag" data-label="Payment Status">
                                        <br>
                                        <a style="padding-right: 10px;"
                                            href="{{ route('reportmanager.show', $report->id) }}"><i
                                                class='bx bxs-low-vision'></i></a>
                                        <br>
                                        <a style="padding-right: 10px;"
                                            href="{{ route('reportmanager.edit', $post->user_id) }}"><i
                                                class='bx bx-block'></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button style="padding-right: 10px;">
                                            <i class='bx bx-check-square'></i>
                                            <i class='bx bx-checkbox'></i>
                                        </button>
                                    </div>
                                </li>
                            </form>
                        @endif
                    @endforeach
                @endforeach
            </ul>

        </div>

        <br>
        <div class="container">
            <h2>COMENTÁRIOS DENÚNCIADOS</h2>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">User_ID</div>
                    <div class="col col-2">Palavra</div>
                    <div class="col col-3">Comentário</div>
                    <div class="col col-4"></div>
                </li>
                @foreach ($comment_reports as $comment_report)
                    @foreach ($comments as $comment)
                        @if ($comment_report->comment_id == $comment->id)
                            <form action="{{ route('commentreportmanager.destroy', $comment_report->id) }}" method="POST">
                                <li class="table-row">
                                    <div class="col col-1" data-label="Job Id">{{ $comment->name }} </div>
                                    <div class="col col-2" data-label="Customer Name">{{ $comment->comment }} </div>
                                    <div class="col col-3" data-label="Amount">{{ $comment_report->reason }} </div>
                                    <div class="col col-4 ButtonFlag" data-label="Payment Status">
                                        <br>
                                        <a style="padding-right: 10px;"
                                            href="{{ route('commentreportmanager.show', $comment_report->id) }}">
                                            <ion-icon name="eye-outline"></ion-icon>
                                        </a>
                                        <br>
                                        @csrf
                                        @method('DELETE')
                                        <button style="padding-right: 10px;">
                                            <ion-icon name="checkmark-done-outline"></ion-icon>
                                        </button>
                                    </div>
                                </li>
                            </form>
                        @endif
                    @endforeach
                @endforeach
            </ul>
        </div>
        <br>
        <div class="container">
            <h2>USUÁRIOS DENÚNCIADOS</h2>
            <ul class="responsive-table">
                <li class="table-header">
                    <div class="col col-1">User_ID</div>
                    <div class="col col-2">Palavra</div>
                    <div class="col col-3">Comentário</div>
                    <div class="col col-4"></div>
                </li>
                <li class="table-row">
                    <div class="col col-1" data-label="Job Id">user123</div>
                    <div class="col col-2" data-label="Customer Name">Trash</div>
                    <div class="col col-3" data-label="Amount">AAAAAAAAAAA</div>
                    <div class="col col-4 ButtonFlag" data-label="Payment Status">
                        <a style="padding-right: 10px;">
                            <ion-icon name="trash-outline"></ion-icon>
                        </a>
                        <br>
                        <a>
                            <ion-icon name="checkmark-done-outline"></ion-icon>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    </div>
    </div>
    <!-- The Modal -->
@endsection
