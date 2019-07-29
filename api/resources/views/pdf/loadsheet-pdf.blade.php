<style>
    table,th,td{
        border:1px solid black;
        border-collapse : collapse;
    }
    
    td{
       
    }
    
    img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    </style>
    
    
    <table  style ="border:1px solid black;" align="center">
       
            <tr style ="border:none">
                    <td colspan ="3" style="border:none !important">
                        <img  src="http://admin.amalooloo.oneills.photography/img/logo-icon.png" alt="Amalooloo" class="center" style="height: 110px;">
                    </td>
                    <td colspan="4" style="border:none !important">&nbsp</td>
                    
            <td   colspan ="3">DELIVERY NOTE NUMBER:PTA<br>
                DATE:
    
               
             </td>
            </tr>
            <tr>
                <td colspan="3" style ="border:none">
                </td>
                <td colspan="4" style ="border-top:none;border-bottom:none;border-left:none;">
                    </td>
             <td colspan="3">
             <p>9 Steenbook Stret,Koedoesport-Industrial<br>
                Tel:(012)333-8236 Fax:(012)333-8418<br>
                betram@mweb.co.za &nbsp; regno.1986004256/07
                </p>
             </td>
    
             @foreach ($data as $key => $value)        
        <tr>
            <td> Loadsheet No. :</td>
            <td style="color: #616A6B;">{{ $value['loadsheet_no']}}</td>
            <td colspan ="5" style="border:none !important">&nbsp</td>
            <td colspan="2"> Loadsheet Completed At :</td>
            <td colspan ="2" style="color: #616A6B;">{{ $value['branch_name'] }}</td>
        </tr>
        <tr>
            <td > Load Date :</td>
            <td style="color: #616A6B;">{{ date('d-m-Y',strtotime($value['schedule_date'])) }}</td>
            <td colspan ="5" style="border:none !important">&nbsp</td>
            <td colspan="2"> Load Time :</td>
            <td colspan ="2" style="color: #616A6B;">{{ $value['emp_mention_time'] }}</td>
        </tr>
        @endforeach
    
     

        @foreach ($alldata as $key => $value)
        <tr>
            <td> Client:</td>
            <td >{{ $value['client_name'] }}</td>
         @endforeach
            <td colspan ="5" style="border:none !important; color: #616A6B;">&nbsp</td>
            @foreach ($transport as $key => $value)
            <td colspan= "2">Transport Company:</td>
            <td colspan ="2" style="color: #616A6B;">{{ $value['transport_company'] }}</td>
        </tr>
        @endforeach

       
    </tr>
    <tr>
            <td style="border:none !important">&nbsp</td> 
            <td style="border-left:none !important">&nbsp</td>
            <td colspan= "5"style="border:none !important" > &nbsp</td>
            <td colspan= "2"> &nbsp</td>
            <td colspan= "2"style="border-left:none !important" > &nbsp</td>
            
    </tr>
        

            
           
           <tr>
               <td colspan="9" style="vertical-align: top;">
                   <table style ="border-color: white; width:100%;">
            {{-- @foreach ($clientorder as $key => $value)  --}}
            @foreach ($alldata as $key => $value) 
                    
                     {{-- <tr >            
                    <td  colspan ="2" align="left"  style="border:none !important;"><strong>  Order {{$key}}</strong></td> 
                    <td  colspan ="2" style="border:none !important">&nbsp</td> 
                    </tr> --}}
                  
                    
                    {{-- @foreach ($products as $key => $value) --}}
                    @foreach ($value['products'] as $key => $component)
                                <tr>
                                        
                    <td colspan ="2" style="text-align:right; border-right:none !important;"><strong>Product:{{ $key }} </strong> </td> 
                    <td  colspan ="2" align="left"  style="border-left:none !important;"><strong>  Order:{{$value['order_no']}}</strong></td> 
                    
                                </tr>
                   
                  
                    <tr class="border_bottom">
                       
                        <td  colspan ="2" style="text-align: left;"><strong>Component Name</strong></td>
                        <td  colspan ="2" style="text-align: center;"><strong>Quantity</strong></td>
                        {{-- <td style="text-align: center;"><strong>Rate (Excl. VAT)</strong></td>
                        <td style="text-align: center;"><strong>Status</strong></td> --}}
                        
                      
                    </tr>
                    @foreach ($component as $key => $value)
                    <tr class="border-right">
                            <td colspan ="2" style="text-align:left; color: #616A6B;">
                                {{ $value['component_name'] }}
                                 
                            </td>
        
                            <td  colspan ="2" style="text-align:center; color: #616A6B;">
                                {{ $value['quantity'] }}
                                 
                            </td>
        
                            {{-- <td style="text-align:center; color: #616A6B;">
                                {{ $value['rate'] }}    
                            </td>
                            
                            <td style="text-align:center; color: #616A6B;">
                                {{($value['quantity'] - $value['delivered_quantity'] == 0)?'Delivered':'Back Order'}}
                            </td> --}}

                            
                                
        
                    </tr>
                    @endforeach
                    @endforeach
                @endforeach
                   </table>
                </td>

                <td colspan="2" style="vertical-align: top;">
                        <table width="100%" style="border-right: none; border-left:none; border-bottom:none; ">
                                @foreach ($data as $key => $value)

                                

                                {{-- <tr >
                                    <th style="border:none !important; height:200px;">
                                            
                                    </th >
                                </tr> --}}

                                    <tr class="border_bottom">
                                        <th  style="text-align: center;"><strong>Image1</strong></th>
                                    </tr>

                                    <tr >
                                            <td style="text-align:center; border:none; height: 100px;">
                                                    @php
                                                    if($value['image_1']) {
                                                        @endphp
                                                        <img src="http://admin.amalooloo.oneills.photography/{{$value['image_1']}}" alt="" border=3 height=100px width=160px>
                                                        @php
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                                 
                                            </td>
                                        </tr>

                                        {{-- <tr >
                                            <th style="border:none !important; height:200px;">
                                                    
                                            </th >
                                        </tr> --}}

                                       

                                        <tr>
                                            <th style="text-align: center; "><strong>Image2</strong></th> 
                                        </tr>
                                        <tr>
                        
                                            <td   style="text-align:center; border:none;height: 100px;">
                                                    @php
                                                    if($value['image_2']) {
                                                        @endphp
                                                        <img src="http://admin.amalooloo.oneills.photography/{{$value['image_2']}}" alt="" border=3 height=100px width=160px>
                                                        @php
                                                    } else {
                                                        echo 'N/A';
                                                    }
                                                @endphp
                                                 
                                            </td>
                                        </tr>

                                        <tr >
                                                {{-- <th style="border:none !important; height:200px;">
                                                        
                                                </th >
                                            </tr>    --}}
                        
                                        <tr>
                                                <th style="text-align: center;"><strong>Image3</strong></th> 
                                            </tr>
                                            <tr>
                                            <td style="text-align:center; border:none; height:100px;">
                                                    @php
                                                        if($value['image_3']) {
                                                            @endphp
                                                            <img src="http://admin.amalooloo.oneills.photography/{{$value['image_3']}}" alt="" border=3 height=100px width=160px>
                                                            @php
                                                        } else {
                                                            echo 'N/A';
                                                        }
                                                    @endphp
                                            </td>
                        
                                    </tr>
                                    <tr  class="border_bottom">
                                        <th  style="text-align: center;"><strong>Comments</strong></th>
                                        
                                    </tr>
                                    <tr class="border_bottom" style="height:57px; border:none;"><td style="border:none;">
                                        </td></tr>
                                    @endforeach
                                </table> 
                </td>
           </tr> 
    
                                  
    
                                   

                     

                                           @foreach ($data as $key => $value)
                                            <tr>
                                                    <td style="border-right:none;"><strong>Name of User:</strong></td>
                                                    <td colspan="4"style="text-align:left; border:none;">{{ $value['emp_name'] }} {{$value['emp_surname']}} </td>
                                                    <td style ="border:none;" colspan="2">&nbsp</td>    
                                                        <td colspan="2" style="text-align: right;"><strong>Sign:</strong></td> 
                                                    <td style="text-align:center;">
                                                        {{-- @php
                                                        if($value['emp_sign']) {
                                                            @endphp
                                                            <img src="http://admin.amalooloo.oneills.photography/{{$value['emp_sign']}}" alt="" border=3 height=100 width=100>;
                                                            @php
                                                        } else {
                                                            echo 'N/A';
                                                        }
                                                    @endphp --}}
                                                     
                                                </td>
                                            @endforeach

                                                </tr>
                                                                                            

                    @foreach ($data as $key => $value)
                                                <tr>
                                                        <td style="border-right:none;"><strong>Name of Driver:</strong></td>
                                                        <td colspan="4" style="text-align:left; border-left:none; border-right:none;">{{ $value['driver_name'] }} {{$value['driver_surname']}} </td>
                                                        <td colspan="2" style="border-left:none;">&nbsp</td>    
                                                        <td colspan="2" style="text-align: right;"><strong>Sign:</strong></td>                                
                                                        <td colspan ="2" style="text-align:center;">
                                                            {{-- @php
                                                            if($value['emp_sign']) {
                                                                @endphp
                                                                <img src="http://admin.amalooloo.oneills.photography/{{$value['driver_sign']}}" alt="" border=3 height=100 width=100>;
                                                                @php
                                                            } else {
                                                                echo 'N/A';
                                                            }
                                                        @endphp --}}
                                                         
                                                    </td>
                                                @endforeach
                                                    </tr>
                                             
                                    </table>
    
                                    
                                        <table style="border:none !important;" align="center">
                                    <tr >
                                        
                                        <td  style=" border:none !important;">
                                           <u>Note</u><br>
                                           1. On Signature of this document the recipient acknowledges that all goods are received in good order.<br>
                                           2. Any damages and or shortages to be noted on this document before off-loading.<br>
                                           3. All goods remain the property  of Betran until full and final payment.<br>
                                           4. Terms & conditions as per quotation in conjuction with Betram's Standard Conditions are applicable(Available on request).<br>
                                           5. Customer responsible for providing suitable (even surfaces) and acceptable area for trucks to enter and off-load goods.<br>
                                           6. Customer will be held liable for any costs incurred due to delays with off-loading  of trucks.
                                        </tr>
                                        </table>