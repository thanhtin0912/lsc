<style > 
    .order-app-page {
        position: relative;
        border-bottom: solid 2px #72c02c;
    }
    .order-app-page > a {
        color: #72c02c;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        // setInterval(function() {
            getOrderApp();
        // }, 5000); // 30 seconds
		
    });
    function getOrderApp(){
        $.post('http://localhost/leotea/getOrderForStore',{
            store        : 4
        },function(data){
            data = JSON.parse(data)
            if (data.length) {
                $('.timeline-v2').children().remove();
                
                var str="";
                for (var i = 0; i < data.length; i++) {
                    var dt = new Date(data[i].created);
                    let res = JSON.parse(data[i].data)
                    console.log(res);
                    str+="<li>";
                    str+="<time class='cbp_tmtime'><span>"+dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds()+"</span> <span>"+dt.getDate() + "-" +dt.getMonth()+"</span></time>";
                    str+="<i class='cbp_tmicon rounded-x hidden-xs'></i>";
                    str+="<div class='cbp_tmlabel'>";
                    str+="<h2>Phone khách hàng : "+data[i].customerId+"</h2>";
                    str+="<div class='row'>";
                    str+="<div class='col-md-12'>";
                    str+="<div class='profile-blog blog-border'>";
                    str+="<div class='name-location'>";
                    for (var j = 0; j < res.items.length; j++) {
                    str+="<strong>"+res.items[j].product.name+" | Size: "+res.items[j].product.is_size+"</strong>";
                        if (res.items[j].product.toppings.length > 0) {
                            str+="<span>";
                            for (var p = 0; p < res.items[j].product.toppings.length; p++) {
                                str+=res.items[j].product.toppings[p].name+"</br>";
                            }
                            str+="</span>";
                        }
                    }
                    str+="<hr>";
                    str+="<strong>Tổng cộng: "+Number((res.total).toFixed(1)).toLocaleString()+"</strong>";
                    str+="</div>";		
                    str+="</div>";
                    str+="<div class='btn-group'>";
					str+="<button class='btn-u btn-u-sm btn-u-sea' type='button'>Nhận đơn</button>";			
					str+="<button class='btn-u btn-u-sm btn-u-red btn-u-split-red' type='button'>Chuyển</button>";
                    str+="<button type='button' class='btn-u btn-u-sm btn-u-red btn-u-split-red dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>";
					str+="<i class='fa fa-sort'></i>";
					str+="<span class='sr-only'>Toggle Dropdown</span>";
					str+="</button>";
                    str+="<ul class='dropdown-menu' role='menu'>";
                    str+="<li><a href='#'>Chi nhánh 1</a></li>";
                    str+="<li><a href='#'>Chi nhánh 2</a></li>";
                    str+="<li><a href='#'>Chi nhánh 3</a></li>";
                    str+="<li><a href='#'>Chi nhánh 4</a></li>";
                    str+="</ul>";
					str+="</div>";
                    str+="</div>";
                    str+="</div>";
                    str+="</div>";
                    str+="</div>";
                    str+="</li>";
                }
                $('.timeline-v2').append(str);
            }
            
        }); 
    }

</script>
<div class="col-md-12">
    <div class="profile-body">
        <!--Timeline-->
        <ul class="timeline-v2" >

            <li>
                <time class="cbp_tmtime" datetime=""><span>4/1/08</span> <span>January</span></time>
                <i class="cbp_tmicon rounded-x hidden-xs"></i>
                <div class="cbp_tmlabel">
                    <h2>Our first step</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-blog blog-border">
                                <div class="name-location">
                                    <strong>Mikel Andrews</strong>
                                    <span><i class="fa fa-map-marker"></i><a href="#">California,</a> <a href="#">US</a></span>
                                </div>
                                <div class="clearfix margin-bottom-20"></div>
                                <p>Donec non dignissim eros. Mauris faucibus turpis volutpat sagittis rhoncus. Pellentesque et rhoncus sapien, sed ullamcorper justo.</p>
                                <hr>
                                <ul class="list-inline share-list">
                                    <li><i class="fa fa-bell"></i><a href="#">12 Notifications</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <!--End Timeline-->
    </div>
</div>

<ul class="dropdown-menu" role="menu">
    <li><a href="#">Fullscreen</a></li>
    <li><a href="#">Some Links</a></li>
    <li><a href="#">Main Links</a></li>
    <li><a href="#">Download All</a></li>
</ul>