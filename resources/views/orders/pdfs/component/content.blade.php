<table>
    <tbody>
        <tr style="line-height: 20px;">
            <th colspan="6" class="text-left">
                {{ 'ส่วนที่ 1 ทำเครื่องหมาย / ที่ช่องว่าง [ ] เพื่อเป็นการยืนยันว่าได้ตรวจเช็คอุปกรณ์และเครื่องมือต่างๆแล้ว' }}
            </th>
        </tr>
        @foreach ($checklist_list as $checklist)
            @if ($loop->iteration % 3 == 1)
                <tr style="line-height: 12px;">
            @endif
            <td style="width:20%; text-align:left;">{{ $checklist->name }}</td>
            <td style="width:10%;" class="text-left">
                <img src="{{ base_path('storage/logo-pdf/no-check.png') }}" style="width:10px; height:10px;"
                    alt=""> ______
            </td>
            @if ($loop->iteration % 3 == 0 || $loop->last)
                </tr>
            @endif
        @endforeach
        <tr style="line-height: 12px;">
            <td style="width:20%; text-align:left;">{{ 'น้ำมัน' }}</td>
            <td style="width:10%;" class="text-left">
                ________
            </td>
            <td style="width:20%; text-align:left;">{{ 'เลขไมล์' }}</td>
            <td style="width:10%;" class="text-left">
                ______ กม.
            </td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="6">
                <table style="line-height: 12px;">
                    <tr style="line-height: 12px;">
                        <td>
                            <table class="border-all">
                                <tr>
                                    <td style="width:5%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                    </td>
                                    <td>ผ่าน</td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt=""></td>
                                    <td>ไม่ผ่าน</td>
                                </tr>
                                <tr>
                                    <td>NCR</td>
                                    <td style="width:10%;" class="text-left">...........</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="border-all">
                                <tr>
                                    <td>ผู้ส่งมอบ</td>
                                    <td>(True Leasing)</td>
                                </tr>
                                <tr>
                                    <td>ลงชื่อ</td>
                                    <td>___________</td>
                                </tr>
                                <tr>
                                    <td>วันที่</td>
                                    <td>___________</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td style="width:50%;">
                            <table class="border-all">
                                <tr>
                                    <td>
                                        ข้าพเจ้าได้รับรถคันดังกล่าวพร้อมเครื่องมือและอุปกรณ์เป็นที่เรียบร้อยแล้ว
                                        {{-- จึงเซ็นชื่อไว้เป็นหลักฐานผู้รับมอบ (Supplier) --}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>จึงเซ็นชื่อไว้เป็นหลักฐานผู้รับมอบ (Supplier)</td>
                                </tr>
                                <tr>
                                    <td>ลงชื่อ</td>
                                </tr>
                                <tr>
                                    <td class="text-center">วันที่ ______________________</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr style="line-height: 20px;">
            <th colspan="6" class="text-left">
                {{ 'ส่วนที่ 2 ตรวจรับอุปกรณ์ที่ติดตั้งและเครื่องมือต่างๆตามส่วนที่ 1' }}</th>
        </tr>
        @foreach ($install_equipments as $install_equipment)
            <tr style="line-height: 12px;">
                <td colspan="6" class="text-left">
                    {{ 'เลขที่ ' . $install_equipment->worksheet_no }}
                    {{ '  Supplier: ' . $install_equipment->supplier_name }}
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td colspan="3">
                    <table>
                        <tr>
                            <td>ที่</td>
                            <td>รายการ</td>
                            <td>รุ่น</td>
                            <td>มี</td>
                            <td>มี</td>
                            <td>ผ่าน</td>
                            <td>ไม่ผ่าน</td>
                        </tr>
                        <tr></tr>
                        @foreach ($install_equipment->checklist_list as $ie_index => $ie_checklist)
                            <tr style="line-height: 12px;">
                                <td>{{ $ie_index + 1 }}</td>
                                <td>{{ $ie_checklist->accessory ? $ie_checklist->accessory->name : '' }}</td>
                                <td>{{ $ie_checklist->accessory ? $ie_checklist->accessory->version : '' }}</td>

                                <td class="text-left">
                                    <img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                        style="width:10px; height:10px;" alt="">
                                </td>
                                <td class="text-left">
                                    <img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                        style="width:10px; height:10px;" alt="">
                                </td>
                                <td class="text-left">
                                    <img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                        style="width:10px; height:10px;" alt="">
                                </td>
                                <td class="text-left">
                                    <img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                        style="width:10px; height:10px;" alt="">
                                </td>
                            </tr>
                        @endforeach
                        <tr></tr>
                    </table>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="6">
                <table>
                    <tr style="line-height: 12px;">
                        <td>
                            <table class="border-all">
                                <tr>
                                    <td style="width:5%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                    </td>
                                    <td>ผ่าน</td>
                                </tr>
                                <tr>
                                    <td style="width:5%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt=""></td>
                                    <td>ไม่ผ่าน NCR...................</td>
                                </tr>
                                <tr>
                                    <td>ส่งกลับแก้ไข</td>
                                    <td style="width:10%;" class="text-left"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr style="line-height: 30px;">
                                    <td></td>
                                    <td style="width:10%;" class="text-left">...................................</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="width:10%;" class="text-left">(สกนธ์ อาศัยราษฎร์)</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="border-all">
                                <tr>
                                    <td>สีถูกต้องไม่มีรอยขีดข่วน รอยบุบ ฯลฯ</td>
                                    <td style="width:20%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ผ่าน
                                    </td>
                                    <td style="width:20%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ไม่ผ่าน...............
                                    </td>
                                </tr>
                                <tr>
                                    <td>อุปกรณ์และเครื่องมือต่างๆครบตามส่วนที่ 1</td>
                                    <td style="width:20%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ตรง
                                    </td>
                                    <td style="width:20%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ไม่ตรง...............
                                    </td>
                                </tr>
                                <tr>
                                    <td>ความสะอาด</td>
                                    <td style="width:25%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        เรียบร้อย
                                    </td>
                                    <td style="width:25%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ไม่เรียบร้อย...............
                                    </td>
                                </tr>
                                <tr>
                                    <td>พนักงานให้บริการ</td>
                                    <td style="width:20%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ดีสุภาพ
                                    </td>
                                    <td style="width:20%;" class="text-left">
                                        &nbsp;<img src="{{ base_path('storage/logo-pdf/no-check.png') }}"
                                            style="width:10px; height:10px;" alt="">
                                        ไม่ดี...............
                                    </td>
                                </tr>
                            </table>
                            <table class="border-all">
                                <tr>
                                    <td>ผู้ส่งมอบ (Supplier)</td>
                                    <td>ผู้รับมอบ (True Leasing)</td>
                                </tr>
                                <tr>
                                    <td>ลงชื่อ</td>
                                    <td>ลงชื่อ</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>วันที่ ......................................</td>
                                    <td>วันที่ ......................................</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="2">น้ำมัน ......................................</td>
            <td colspan="2">จอด Zone ......................................</td>
            <td colspan="2">เลขไมล์ ...................................... กม.</td>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
        <tr style="line-height: 30px;">
            <td colspan="2"></td> 
            <td colspan="4" class="text-center">............................................................</td>
        </tr>
        <tr>
            <td colspan="2"></td> 
            <td colspan="4" class="text-center">(ผู้ตรวจรับ QA)</td>
        </tr>
    </tbody>
</table>