
 <div class="row">
    <div class="col-md-12">
        <div style="text-align: center; background-color: rgba(199, 189, 165, 1); padding: 0.7rem; border-radius: 10px 10px 0px 0px ;">
            <p style="line-height: 0.7rem; color: white; font-size: 1.6rem;">Search</p>
        </div>
        <div style="background-color: rgba(199, 189, 165, 0.7); padding:0.7rem; border-radius: 0px 0px 10px 10px;">
            <form id="form" action={{ route('postSearch') }} method="get" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="keyword">フリーワード</label>
                    <input type="text" class='form-control' id="keyword" name="keyword">
                </div>
                <div class='form-group'>
                    <label for="budget">予算</label>
                    <select id="budget" class="form-control" name="budget" value="">
                        <option value="" selected></option>
                        <option value="1">~1万円</option>
                        <option value="2">1万円~3万円</option> 
                        <option value="3">3万円~5万円</option>
                        <option value="4">5万円~10万円</option>
                        <option value="5">10万円~20万円</option>
                        <option value="6">20万円~</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="term">期間</label>
                    <select id="term" class="form-control" name="term" value="">
                        <option value="" selected></option>
                        <option value="1">日帰り</option>
                        <option value="2">1泊2日</option>
                        <option value="3">2泊3日</option>
                        <option value="4">3泊4日</option>
                        <option value="5">5日間</option>
                        <option value="6">6日間</option>
                        <option value="7">7日間</option>
                        <option value="8">8日間</option>
                        <option value="9">9日間</option>
                        <option value="10">10日間〜</option>
                    </select>
                </div>
                <div class='form-group'>
                    <label for="month">月</label>
                        <select id="month" class="form-control" name="month" value="">
                            <option value="" selected></option>
                            <option value="1">1月</option>
                            <option value="2">2月</option>
                            <option value="3">3月</option>
                            <option value="4">4月</option>
                            <option value="5">5月</option>
                            <option value="6">6月</option>
                            <option value="7">7月</option>
                            <option value="8">8月</option>
                            <option value="9">9月</option>
                            <option value="10">10月</option>
                            <option value="11">11月</option>
                            <option value="12">12月</option>
                        </select>
                <div class='form-group'>
                    <label for="tag">タグ</label>
                    <select id="tag" class="form-control" name="tag" value="">
                        <option value="" selected></option>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->tag_id}}">{{$tag->tag_name}}</option>
                            @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-12" style="">
                        <button class="btn" style="background-color: #c691a5; color: white; width: 100%" type="submit">検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
 </div>
 
 
