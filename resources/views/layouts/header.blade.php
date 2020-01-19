{{-- メニュー閉じた状態デフォルト --}}
<header>
        <div id="nav-toggle">
            <div></div>
            <div></div>
            <div></div>
        </div>
</header>
{{-- メニュー開いた状態 --}}
<div id="global-nav">
    <nav>
        <ul class="gblnv_list">
            <li class="menu_list">
                サービス
            </li>
            @if(Auth::check())
              <li class="menu_list">
                {{ \Auth::user()->name }}さん<br />
                <a href="/auth/logout">ログアウト</a>
              </li>
            @else
              <li class="menu_list">
                <a href="/auth/login">ログイン</a><br />
              </li>
              <li class="menu_list">
                <a href="/auth/register">会員登録</a>
              </li>
            @endif
            <li class="menu_list">
                お問い合わせ
            </li>
            <li class="menu_list">
                ブログ
            </li>
        </ul>
    </nav>
</div>
