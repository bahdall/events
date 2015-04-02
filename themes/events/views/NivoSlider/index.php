
<section id="home" class="slider-content container">
    <div class="tp-banner-container">
        <div class="tp-banner" >
            <ul>	<!-- SLIDE  -->
                <?if(count($this->images)) {?>
                    <?foreach($this->images as $image):?>
                        <!-- SLIDE  -->
                        <li data-transition="fade" data-slotamount="5" data-masterspeed="700" data-thumb="<?=$image['src']?>" data-delay="10000" data-title="">

                            <!-- MAIN IMAGE -->
                            <img src="<?=$image['src']?>" alt="slidebg1"  data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat">

                            <!-- LAYERS -->

                            <!-- LAYER NR. 1 -->
                            <div class="tp-caption css-slide-title sft tp-resizeme"
                                 data-x="50"
                                 data-y="170"
                                 data-speed="300"
                                 data-start="1500"
                                 data-easing="Power3.easeInOut"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-elementdelay="0.1"
                                 data-endelementdelay="0.1"
                                 data-endspeed="300">
                                <?=$image['title']?>
                            </div>

                            <!-- LAYER NR. 2 -->
                            <div class="tp-caption css-small-text sft tp-resizeme"
                                 data-x="50"
                                 data-y="210"
                                 data-speed="300"
                                 data-start="1800"
                                 data-easing="Power3.easeInOut"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-elementdelay="0.1"
                                 data-endelementdelay="0.1"
                                 data-endspeed="300">
                                <?=$image['description']?>
                            </div>

                            <!-- LAYER NR. 4 -->
                            <div class="tp-caption css-slider-btn sft tp-resizeme"
                                 data-x="50"
                                 data-y="280"
                                 data-voffset="70"
                                 data-speed="300"
                                 data-start="2100"
                                 data-easing="Power3.easeInOut"
                                 data-splitin="none"
                                 data-splitout="none"
                                 data-elementdelay="0.1"
                                 data-endelementdelay="0.1"
                                 data-endspeed="300">
                                <?=$image['url']?>
                            </div>
                        </li>
                        <!-- SLIDE  -->
                    <?endforeach;?>
                <?}?>

            </ul>
            <div class="tp-bannertimer"></div>	</div>
    </div>
</section>
<!-- /end slider section -->