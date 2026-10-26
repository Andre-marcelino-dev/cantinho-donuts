  <!--Main Slider-->
    <section class="main-slider">
        <div class="slider_wave"></div>
        <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>    <!-- SLIDE  -->
                    @foreach ($listaBanner as $linha )


                    <li data-index="rs-10" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="850"  data-thumb=""  data-delay="5999"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="{{asset('donuts/images/banner/'. $linha->foto_banner)}}"  alt="" title="Home Lollipop"  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                        <!-- LAYERS -->




                    </li>
                       @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!--End Main Slider-->
