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
                        
                <td   colspan ="3">Construction NOTE NUMBER:PTA<br>
                    DATE:
        
                   
                 </td>
                </tr>
                <tr>
                    <td colspan="3" style ="border:none">
                    </td>
                    <td style ="border-top:none;border-bottom:none;border-left:none;">
                        </td>
                 <td colspan="3">
                 <p>9 Steenbook Stret,Koedoesport-Industrial<br>
                    Tel:(012)333-8236 Fax:(012)333-8418<br>
                    betram@mweb.co.za &nbsp; regno.1986004256/07
                    </p>
                 </td>
        
                 @foreach ($data as $key => $value)        
            <tr>
                <td> Project Name :</td>
                <td style="color:#616A6B;">{{ ($value['project_name']?$value['project_name']:'N/A')}}</td>
                <td colspan ="2" style="border:none !important">&nbsp</td>
                <td > Manager Name :</td>
                <td colspan ="2" style="color:#616A6B;">{{ ($value['project_manager_name'])?$value['project_manager_name']:'N/A' }}</td>
            </tr>
            <tr>
                <td > Manager No :</td>
                <td style="color:#616A6B;">{{ ($value['project_manager_no'])?$value['project_manager_no']:'N/A' }}</td>
                <td colspan ="2" style="border:none !important">&nbsp</td>
            </tr>
            @endforeach
    
           
        </tr>
        <tr>
                <td style="border:none !important">&nbsp</td> 
                <td style="border-left:none !important">&nbsp</td>
                <td colspan= "2"style="border:none !important" > &nbsp</td>
                <td > &nbsp</td>
                <td colspan= "2"style="border-left:none !important" > &nbsp</td>
                
        </tr>       
               
               <tr>
                   <td colspan="4">
                       <table style ="border-color: white;">
                            @foreach ($data as $key => $value)

                            
                            <tr class="border_bottom">
                                <th style = "text-align:left">Description</th>
                                <td style="color:#616A6B;">{{ $value['description'] }}</td>
                            </tr>
                            <tr class="border_bottom">
                                <th style = "text-align:left">User Name</th>
                                <td style="color:#616A6B;">{{ $value['emp_name'] }}</td>
                            </tr>
                            <tr class="border_bottom">
                                <th style = "text-align:left">Note</th>
                                <td style="color:#616A6B;">{{ $value['const_note'] }}</td>
                            </tr>
                            
                            <tr class="border_bottom">
                                <th>Contractor Name</th>
                                <td style="color:#616A6B;">{{ $value['cont_name'] }} {{$value['cont_surname']}}</td>
                            </tr>
                            
                                
                                    
            
                        </tr>
                       
                        @endforeach

   
                         @foreach ($questionData as $key => $value)
                        <tr>
                                
                                    
                                      
             
                                         
                                         <tr class="border_bottom">
                                             <th style = "text-align:left">Questions</th>
                                             <td style="color:#616A6B;">{{ ($value['question']?$value['question']:'N/A')}}</td>
                                         </tr>
                                         <tr class="border_bottom">
                                             <th style = "text-align:left">Answers</th>
                                             <td style="color:#616A6B;">{{ ($value['answer'])?$value['answer']:'N/A' }}</td>
                                         </tr>
                                         <tr class="border_bottom">
                                             <th style = "text-align:left">Note</th>
                                             <td style="color:#616A6B;">{{ ($value['note'])?$value['answer']:'N/A' }}</td>
                                         </tr>
                                         
                                
                                     </tr>
                                     @endforeach 
                       
                      




                       </table>
                    </td>
    
                    <td colspan="3">
                            <table width="100%" style="border-right: none; border-left:none">
                                    @foreach ($data as $key => $value)
                                        <tr  class="border_bottom">
                                            <th  style="text-align: center;"><strong>Image1</strong></th>
                                        </tr>
                                        <tr rowspan="8">
                                                <td style="text-align:center;">
                                                        @php
                                                        if($value['image_1']) {
                                                            @endphp
                                                            <img src="http://admin.amalooloo.oneills.photography/{{$value['image_1']}}" alt="" border=3 height=100 width=100>;
                                                            @php
                                                        } else {
                                                            echo 'N/A';
                                                        }
                                                    @endphp
                                                     
                                                </td>
                                            </tr>
    
                                           
    
                                           
    
                                            <tr>
                                                <th style="text-align: center;"><strong>Image2</strong></th> 
                                            </tr>
                                            <tr>
                            
                                                <td style="text-align:center;">
                                                        @php
                                                        if($value['image_2']) {
                                                            @endphp
                                                            <img src="http://admin.amalooloo.oneills.photography/{{$value['image_2']}}" alt="" border=3 height=100 width=100>;
                                                            @php
                                                        } else {
                                                            echo 'N/A';
                                                        }
                                                    @endphp
                                                     
                                                </td>
                                            </tr>
    
                                            
                            
                                            <tr>
                                                    <th style="text-align: center;"><strong>Image3</strong></th> 
                                                </tr>
                                                <tr>
                                                <td style="text-align:center;">
                                                        @php
                                                            if($value['image_3']) {
                                                                @endphp
                                                                <img src="http://admin.amalooloo.oneills.photography/{{$value['image_3']}}" alt="" border=3 height=100 width=100>;
                                                                @php
                                                            } else {
                                                                echo 'N/A';
                                                            }
                                                        @endphp
                                                </td>
                            
                                        </tr>
                                        @endforeach
                                    </table> 
                    </td>
               </tr> 
                                       
    
               
    
                                               @foreach ($data as $key => $value)
                                                <tr>
                                                        <td><strong>Name of Contractor:</strong></td>
                                                        <td style="text-align:center; color:#616A6B;">{{ $value['cont_name'] }} {{$value['emp_surname']}} </td>
                                                        <td colspan="3">&nbsp</td>    
                                                        <td ><strong>Sign:</strong></td> 
                                                        <td style="text-align:center;">
                                                            @php
                                                            if($value['cont_sign']) {
                                                                @endphp
                                                                <img src="http://admin.amalooloo.oneills.photography/{{$value['cont_sign']}}" alt="" border=3 height=100 width=100>;
                                                                @php
                                                            } else {
                                                                echo 'N/A';
                                                            }
                                                        @endphp
                                                         
                                                    </td>
                                                @endforeach
    
                                                    </tr>

                                                    @foreach ($data as $key => $value)
                                                    <tr>
                                                            <td><strong>Name of Beneficiary:</strong></td>
                                                            <td style="text-align:center; color:#616A6B;">{{ $value['beneficiary_name'] }} </td>
                                                            <td colspan="3">&nbsp</td>    
                                                            <td ><strong>Sign:</strong></td> 
                                                            <td style="text-align:center;">
                                                                @php
                                                                if($value['beneficiary_sign']) {
                                                                    @endphp
                                                                    <img src="http://admin.amalooloo.oneills.photography/{{$value['beneficiary_sign']}}" alt="" border=3 height=100 width=100>;
                                                                    @php
                                                                } else {
                                                                    echo 'N/A';
                                                                }
                                                            @endphp
                                                             
                                                        </td>
                                                    @endforeach
        
                                                        </tr>
                        
                                                 
                                        </table>
        
                                        
                                            <table style="border:none !important;" align="center">
                                        <tr >
                                            
                                            <td  style=" border:none !important; padding-left: 100;">
                                               <u>Note</u><br>
                                               1. On Signature of this document the recipient acknowledges that all goods are received in good order.<br>
                                               2. Any damages and or shortages to be noted on this document before off-loading.<br>
                                               3. All goods remain the property  of Betran until full and final payment.<br>
                                               4. Terms & conditions as per quotation in conjuction with Betram's Standard Conditions are applicable(Available on request).<br>
                                               5. Customer responsible for providing suitable (even surfaces) and acceptable area for trucks to enter and off-load goods.<br>
                                               6. Customer will be held liable for any costs incurred due to delays with off-loading  of trucks.
                                            </tr>
                                            </table>