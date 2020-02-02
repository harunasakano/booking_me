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
                    <a href="{{ route('user.show',[\Auth::user()->id ])}}">
                        <span class="logged_in_user_name">{{ \Auth::user()->name }}さん</span></a>
                    <a href="/logout" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @else
                <li class="menu_list">
                    <a href="/login">ログイン</a><br/>
                </li>
                <li class="menu_list">
                    <a href="/register">会員登録</a>
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
