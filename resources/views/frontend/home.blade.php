@extends('frontend.layouts')



@section('content')
    <section class="ptb-100 functionalities bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <img src="{{ URL::asset('images/frontend/index_c4.png') }}" class="img-responsive" alt="image">
                        <!--<img src="{{ URL::asset('images/frontend/aaaa.png') }}" class="img-responsive" alt="image">-->

                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="main-title">
                            <h3>我们的优势</h3>
                            <div class="seperator"></div>
                        </div>
                        <p>
                            分布式账本，为用户营造一个安全、信任的业务环境；<br>
                            高并发交易、海量数据存储、模块化设计、完备工具集、广泛场景支持、分级授权的API接口，帮助用户快速实现业务功能。
                        </p>
                        <div class="row" style="margin: 20px 0;">
                            <div class="col-md-2 col-sm-2 col-xs-2 clearl">
                                <div class="iconbox-center">
                                    <table>
                                        <tr>
                                            <td align="center">
                                                <img src="{{ URL::asset('images/frontend/icon_jiaoyi.png') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>高并发交易
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 clearl">
                                <div class="iconbox-center">
                                    <table>
                                        <tr>
                                            <td align="center">
                                                <img src="{{ URL::asset('images/frontend/icon_shuju.png') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>海量数据存储</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 clearl">
                                <div class="iconbox-center">
                                    <table>
                                        <tr>
                                            <td align="center">
                                                <img src="{{ URL::asset('images/frontend/icon_mokuai.png') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>模块化设计</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 clearl">
                                <div class="iconbox-center">
                                    <table>
                                        <tr>
                                            <td align="center">
                                                <img src="{{ URL::asset('images/frontend/icon_gongju.png') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>完备工具集</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 clearl">
                                <div class="iconbox-center">
                                    <table>
                                        <tr>
                                            <td align="center">
                                                <img src="{{ URL::asset('images/frontend/icon_changjing.png') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>广泛场景支持</p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-2 clearl">
                                <div class="iconbox-center">
                                    <table>
                                        <tr>
                                            <td align="center">
                                                <img src="{{ URL::asset('images/frontend/icon_auth.png') }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p>分级授权</p>
                                            </td>
                                        </tr>
                                    </table>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- End Container -->
        </section><!-- End Section -->
        <section class="ptb-100 functionalities bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="main-title">
                            <h3>供应链与区块链</h3>
                            <div class="seperator"></div>
                        </div>
                        <p>
                            未来的供应链是数字供应链、大协同供应链、跨组织跨团队供应链、去中心化的供应链、无界供应链，
                            供应链链条上组织和个体需要在互信下完成多方交易和信息共享与互换，才可以提升整条供应链的效率！
                            而区块链的核心潜力在于分布式数据库的特性及其如何助益透明、安全和效率。二者结合会有原子能量，
                            来驱动供应链的创新变革，让供应链链条上组织共创、共生、共赢！
                        </p>

                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <img src="{{ URL::asset('images/frontend/index_c2.png') }}" class="img-responsive" alt="image">
                    </div>
                </div>
            </div><!-- End Container -->
        </section><!-- End Section -->
        <section class="ptb-100 functionalities bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <img src="{{ URL::asset('images/frontend/index_c1.png') }}" class="img-responsive" alt="image">
                    </div>
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="main-title">
                            <h3>框架公益与区块链</h3>
                            <div class="seperator"></div>
                        </div>
                        <p>
                            框架基于区块链在商品防伪追溯应用中的技术积累，在物资捐赠公益领域创新性地使用区块链技术，
                            进行测试性应用。目前，对于每一批捐赠物资的物流信息进行多主体区块链记录，并将多个节点写入的信息真实呈现给捐赠者，
                            为框架公益的流程透明化保驾护航，提升公益物资捐赠领域的公信力。
                        </p>

                    </div>
                </div>
            </div><!-- End Container -->
        </section><!-- End Section -->
        <section class="ptb-100 functionalities bg-gray">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-6 col-xs-12">
                        <div class="main-title">
                            <h3>框架区块链防伪追溯</h3>
                            <div class="seperator"></div>
                        </div>
                        <p>
                            利用区块链技术搭建一个包含制造、供应、分销、零售、物流企业及最终用户在内
                            的联盟链，将物流、资金流等信息记录在链上。链上的数据是多方参与共同维护、共同
                            享有，并且利用密码学技术实现了数据的不可篡改、不可抵赖及隐私保护。
                        </p>

                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-12">
                        <img src="{{ URL::asset('images/frontend/index_c3.png') }}" class="img-responsive" alt="image">
                    </div>
                </div>
            </div><!-- End Container -->
        </section><!-- End Section -->
        <section class="team ptb-60">
            <div class="container">
                <div class="super-title">
                    <h2>合作企业</h2>
                    <div class="seperator"></div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_27.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_26.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_25.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_24.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_23.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_32.png') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_22.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_21.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_20.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_19.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_18.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_31.jpg') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_17.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_16.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_15.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_14.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_13.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_12.jpg') }}">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_11.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_10.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_9.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_8.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_7.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_6.jpg') }}">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_29.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_5.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_4.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_30.jpg') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_1.png') }}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/logo_2.jpg') }}">
                        </div>
                    </div>
                </div>

            </div><!-- End Container -->
        </section><!-- End Section -->
        <section class="team">
            <div class="container">
                <div class="super-title">
                    <h2>政府及第三方机构合作</h2>
                    <div class="seperator"></div>
                </div>
                <div class="row">


                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/icon_jyxh.jpg') }}"/>
                            <!--<h3>中国连锁经营协会</h3>-->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/icon_xmxh.jpg') }}"/>
                            <!--<h3>中国畜牧业协会</h3>-->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/icon_bmzx.jpg') }}"/>
                            <!--<h3>中国物品编码中心</h3>-->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/icon_woerma.jpg') }}"/>
                            <!--<h3>沃尔玛</h3>-->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/icon_qhdx.jpg') }}"/>
                            <!--<h3>清华大学</h3>-->
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4 team-column">
                        <div class="team-user">
                            <img src="{{ URL::asset('images/frontend/icon_jyyjy.jpg') }}"/>
                            <!--<h3>中国检验检疫科学研究院-->
                            <!--</h3>-->
                        </div>
                    </div>

                </div>

            </div><!-- End Container -->
        </section>
    
@stop



