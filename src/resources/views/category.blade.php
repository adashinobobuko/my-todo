@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('/css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
  @if(session('message'))
  <div class="category__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if($errors->any())
  <div class="category__alert--danger">
    <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>

<div class="category__content">
  <form class="create-form" action="/categories" method="post">
    @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="name" placeholder="categoryの内容を記載">
    </div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
  <div class="category-table">
    <table class="category-table__inner">
      @if ($categories->isEmpty())
        <p>Categoryがありません。</p>
      @else
        <tr class="category-table__row">
          <th class="category-table__header">Category</th>
        </tr>
        @foreach($categories as $category)
        <tr class="category-table__row">
          <td class="category-table__item">
            <form class="update-form">
              <div class="update-form__item">
                <p class="inputform__item-input">{{ $category['name'] }}</p>
              </div>
            </form>
          </td>
          <td class="category-table__item">
            <form class="delete-form" action="/categories/delete" method="post">
              @method('DELETE')
              @csrf
              <div class="delete-form__button">
                <input type="hidden" name="id" value="{{ $category['id'] }}">
                <button class="delete-form__button-submit" type="submit">削除</button>
              </div>
            </form>
          </td>
        </tr>
        @endforeach
      @endif
    </table>
    <div class="sign-up">
      <a href="/register">Sign up</a>
    </div>
  </div>
</div>
@endsection
