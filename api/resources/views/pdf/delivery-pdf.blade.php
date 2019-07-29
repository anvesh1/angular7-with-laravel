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
                <td style="border:none !important">&nbsp</td>
                
        <td   colspan ="3">DELIVERY NOTE NUMBER:PTA<br>
            DATE:

           
         </td>
        </tr>
        <tr>
            <td colspan="3" style ="border:none">
            </td>
            <td style ="border-top:none;border-bottom:none;border-left:none;">
                </td>
         <td colspan="3" >
         <p>9 Steenbook Stret,Koedoesport-Industrial<br>
            Tel:(012)333-8236 Fax:(012)333-8418<br>
            betram@mweb.co.za &nbsp; regno.1986004256/07
            </p>
         </td>

            
            </tr>       
            @foreach ($data as $key => $value)   
    <tr>
        <td colspan ="2" style="border-right:none !important"> User Name:</td>
        <td style="border-left:none !important; color: #616A6B;">{{ $value['emp_name']}} {{ $value['emp_surname']}} </td>
        <td style="border:none !important">&nbsp</td>
        
        
        <td colspan ="2" style ="border-right:none;"> Transport Company:</td>
        <td style="text-align:center; border-left:none; color: #616A6B">
                {{ $value['transport_company'] }}      
    </tr>
    <tr>      
        <td colspan ="2" style="border-right:none !important"> Contact Person:</td>
        <td style="border-left:none !important; color: #616A6B">{{ $value['contact_person_name'] }}</td>
        <td style="border:none !important">&nbsp</td>
        <td colspan ="2" style="border-right:none !important"> Vehicle Reg Nr:</td>
        <td style="text-align:center; border-left:none !important; color: #616A6B;">{{ $value['vehicle_reg_no']}}</td>    
    </tr>
    <tr>
        
        <td colspan ="2" style="border-right:none !important"> Contact number:</td>
        <td style="border-left:none !important; color: #616A6B;">{{ $value['contact_person_mobile'] }}</td>
        <td style="border:none !important">&nbsp</td>
        <td colspan ="2" style="border-right:none;">Driver's Name:</td>
        <td style="text-align:center; border-left:none !important; color: #616A6B;">{{ $value['driver_name'] }} {{$value['driver_surname']}} </td> 
    </tr>
    <tr>      
        <td colspan ="2" style="border-right:none !important"> Site Address:</td>
        <td style="border-left:none !important; color: #616A6B;">{{ $value['transport_company'] }}</td>
        <td style="border:none !important">&nbsp</td>  
        <td colspan ="2" style=" border-right:none !important;">Driver's Cell Nr:</td>
        <td style="text-align:center; border-left:none !important; color: #616A6B;">{{ $value['driver_mobile'] }} {{$value['driver_surname']}} </td>   
    </tr>
</tr>
@endforeach

<tr>
        <td colspan ="3">&nbsp</td>
        <td style="border:none !important">&nbsp</td>
        <td colspan ="3"> &nbsp</td>
</tr>


<tr>
        <td colspan="4">
            <table style ="border-color: white;">
     @foreach ($alldata as $key => $value) 
    
             
              <tr >
                     <td style="border:none !important">&nbsp</td>            
             <td  align="left"  style="border:none !important;"><strong>Client: {{$value['client_name']}} Order: {{$key}}</strong></td> 
             <td style="border:none !important">&nbsp</td> 
             <td style="border:none !important">&nbsp</td> 
              
                             
            
             </tr>
           
             
             @foreach ($value['products'] as $key => $component)
                         <tr style="border:none;">
                                 <td style="border:none;">&nbsp</td>
             <td style="text-align:center; border:none;"><strong>Product:{{ $key }} </strong> </td> 
             <td style="border:none;">&nbsp</td>
             <td style="border:none;">&nbsp</td>
                         </tr>


    <tr>
        <th style="text-align: left;"> Component Name </th>
        <th style="text-align: left;"> QTY</th>
        <th style="text-align: left;"> Ratio/Unit </th>
        <th style="text-align: left;"> Qty Loaded </th>
        <th style="text-align: left;"> Qty Recv </th>
        <th style="text-align: left;" colspan="2"> Urine Diversion Ecological System </th>
    </tr>
    @foreach ($component as $key => $value)
    <tr class="border_bottom">
            <td  style="text-align:left; color: #616A6B">
                {{ $value['component_name'] }} 
                 
            </td>
                    <td style="text-align:left; color: #616A6B">
                        {{ $value['quantity'] }} 
                        </td>
                    </td>
                    <td  style="text-align:left; color: #616A6B">
                        </td>

                        <td style="text-align:center; color: #616A6B">
                                {{ $value['load_quantity'] }}
                            </td>

                            <td style="text-align:center; color: #616A6B">
                                    {{($value['quantity'] - $value['delivered_quantity'] )}}
                                </td>
                                <td style="text-align:left; color: #616A6B">   
                                    </td>
                                    <td style="text-align:left; color: #616A6B">   
                                        </td>
                             

                    
        </tr>
        
        @endforeach
        @endforeach
        @endforeach
           </table>
        </td>

        <td colspan="4" style="vertical-align:top; "> 
            <table width ="100%"> 
        <td style="text-align:center; border-collapse: collapse; vertical-align: top;"><strong>Comments</strong></td>
            </table>
        </td>

        {{-- <tr>
                <th style="text-align: left;"> Pit Structure </th>
                <th style="text-align: left;"> QTY</th>
                <th style="text-align: left;"> Ratio/Unit </th>
                <th style="text-align: left;"> Qty Loaded </th>
                <th style="text-align: left;"> Qty Recv </th>
                <th style="text-align: left;" colspan="2"> Comments</th>
               
                
            </tr>

            @foreach ($componentdetails as $key => $value)  
            <tr class="border_bottom">
                    <td style="text-align:left; color: #616A6B">
                        {{ $value['component_name'] }} 
                         
                    </td>
                            <td  style="text-align:left color: #616A6B">
                                    {{ $value['quantity'] }}
                                </td>
                            </td>
                            <td  style="text-align:left; color: #616A6B">
                                </td>
        
                                <td style="text-align:center; color: #616A6B">
                                        {{ $value['load_quantity'] }}
                                    </td>
        
                                    <td style="text-align:center; color: #616A6B"> 
                                            {{($value['quantity'] - $value['delivered_quantity'] )}}
                                        </td>
                                        <td colspan="2" style="border-top:none;border-bottom:none; color: Gray"">&nbsp;</td>
                                        
        
                            
                </tr>
                
                @endforeach --}}

                    {{-- <tr>
                            <th style="text-align: left;"> Extended Pit Material </th>
                            <th style="text-align: left;"> QTY</th>
                            <th style="text-align: left;"> Ratio/Unit </th>
                            <th style="text-align: left;"> Qty Loaded </th>
                            <th style="text-align: left;"> Qty Recv </th>
                            <th colspan="2" style="border-top:none; border-bottom:none;">&nbsp;</th>
                        </tr>
            
                        @foreach ($componentdetails as $key => $value)
                        <tr >
                                <td style="text-align:left; color: #616A6B">
                                    {{ $value['component_name'] }} 
                                    
                                </td>
                                        <td  style="text-align:left; color: #616A6B">
                                                {{ $value['quantity'] }}
                                            </td>
                                        </td>
                                        <td  style="text-align:left; color: #616A6B">
                                            </td>
                    
                                            <td style="text-align:center; color: #616A6B">
                                                    {{ $value['load_quantity'] }}
                                                </td>
                    
                                                <td style="text-align:center; color: #616A6B">
                                                        {{($value['quantity'] - $value['delivered_quantity'] )}}
                                                    </td>
                                                    <td colspan="2" style="border-top:none;border-bottom:none; color: Gray;">&nbsp;</td>
                    
                                        
                            </tr>
                            
                            @endforeach --}}

                        {{-- <tr>
                                <th style="text-align: left;"> Pit Sealing Material </th>
                                <th style="text-align: left;"> QTY</th>
                                <th style="text-align: left;"> Ratio/Unit </th>
                                <th style="text-align: left;"> Qty Loaded </th>
                                <th style="text-align: left;"> Qty Recv </th>
                                <th colspan="2" style="border-top:none;border-bottom:none">&nbsp;</th>
                            </tr> --}}
                
                            {{-- @foreach ($componentdetails as $key => $value)
                            <tr >
                                    <td style="text-align:left; color: #616A6B">
                                        {{ $value['component_name'] }} 
                                         
                                    </td>
                                            <td  style="text-align:left; color: #616A6B">
                                                {{ $value['quantity'] }}
                                                </td>
                                            </td>
                                            <td  style="text-align:left; color: #616A6B">
                                                </td>
                        
                                                <td style="text-align:center; color:#616A6B">
                                                        {{ $value['load_quantity'] }}
                                                    </td>
                        
                                                    <td style="text-align:center; color:#616A6B">
                                                            {{($value['quantity'] - $value['delivered_quantity'] )}}
                                                        </td>
                                                        <td colspan="2" style="border-top:none;border-bottom:none">&nbsp;</td>
                        
                                            
                                </tr>
                                
                                @endforeach --}}

                                <tr>
                                    <td>&nbsp</td>
                                    <td colspan="2">Concrete</td>
                                    <td>Doors</td>
                                    <td colspan="3" >Channels</td>     
                                    {{-- <td colspan="2" style="border-top:none;border-bottom:none;border-:none;>&nbsp;</td>                                --}}
                                </tr>

                                <tr>
                                        <td><strong>Pallet Quantity:</strong></td>
                                        <td colspan="2">&nbsp</td>
                                        <td >&nbsp</td>
                                        <td >&nbsp</td>    
                                        <td >&nbsp</td>
                                        <td >&nbsp</td>                                
                                    </tr>
                                    @foreach ($employeeloaddetails as $key => $value)
                                    <tr>
                                            
                                           
                                            <td><strong>Name of Betran Loader:</strong></td>
                                            <td style="border-right:none !important; color:#616A6B">{{ $value['emp_name']}} {{ $value['emp_surname']}} </td>
                                            <td colspan="4" style="border-left:none !important">&nbsp</td>    
                                            <td colspan="2"><strong>Sign:</strong></td> 
                                                                         
                                        </tr>

                                        <tr>
                                                <td><strong>Name of Driver:</strong></td>
                                                <td style="text-align:left; border-right:none !important; color:#616A6B">{{ $value['driver_name'] }} {{$value['driver_surname']}} </td> 
                                                <td colspan="4" style="text-align:center; border:none !important">&nbsp</td>    
                                                <td colspan="2" ><strong>Sign:</strong></td>                                
                                            </tr>
                                            @endforeach 
                                            <br>

                                             

                                                
                                </table>

                                
                                    <table style="border:none !important;" align="center">
                                <tr >
                                    
                                    <td  style=" border:none !important; padding-left: 0px;">
                                       <u>Note</u><br>
                                       1. On Signature of this document the recipient acknowledges that all goods are received in good order.<br>
                                       2. Any damages and or shortages to be noted on this document before off-loading.<br>
                                       3. All goods remain the property  of Betran until full and final payment.<br>
                                       4. Terms & conditions as per quotation in conjuction with Betram's Standard Conditions are applicable(Available on request).<br>
                                       5. Customer responsible for providing suitable (even surfaces) and acceptable area for trucks to enter and off-load goods.<br>
                                       6. Customer will be held liable for any costs incurred due to delays with off-loading  of trucks.
                                    </tr>
                                    </table>
                                

                                
                                
                                












