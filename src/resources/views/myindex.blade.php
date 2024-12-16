@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
  @if(session('message'))
  <div class="todo__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if($errors->any())
  <div class="todo__alert--danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<div class="todo__content">
  <form class="create-form" action="/todos" method="post">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="content" placeholder="Todoの内容を記載">
    </div>
    <div class="create-form__item">
      <input class="create-form__item-input" type="date" name="due_date" placeholder="完了期日を入力">
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
  <div class="todo-table">
    <table class="todo-table__inner">
      @if ($todos->isEmpty())
        <p>Todoがありません。</p>
      @else
        <tr class="todo-table__row">
          <th class="todo-table__header">Todo</th>
          <th class="todo-table__header">追加日時</th>
          <th class="todo-table__header">完了期日</th>
          <th class="todo-table__header">アクション</th>
        </tr>
        @foreach($todos as $todo)
        <tr class="todo-table__row">
          <td class="todo-table__item">
            <form class="update-form">
              <div class="update-form__item">
                <tr class="todo-table__row">
                <td class="todo-table__item">{{ $todo->content }}</td>
                <td class="todo-table__item">{{ $todo->created_at->format('Y-m-d H:i') }}</td>
                <td class="todo-table__item">{{ $todo->due_date }}</td>
                <td class="todo-table__item">
              </div>
            </form>
          </td>
          <td class="todo-table__item">
            <form class="delete-form" action="/todos/delete" method="post">
              @method('DELETE')
              @csrf
              <div class="delete-form__button">
                <input type="hidden" name="id" value="{{ $todo['id'] }}">
                <button class="delete-form__button-submit" type="submit">完了</button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      @endif
    </table>
  </div>
</div>
@endsection
