<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            INSERT INTO class_template 
            (
                class_template_uid,
                name,
                payload,
                created_at,
                updated_at
            )
	            VALUES 
            (
                '66a308287167b',
                'TCC 1 Template',
                0x7B0A20202020226E616D65223A20225443432031222C0A202020202273746172745F64617465223A2022323032342D30372D32355430303A3030222C0A202020202261637469766974696573223A205B0A2020202020207B0A2020202020202020226E616D65223A20225465726D6F2064652041636569746520646F204F7269656E7461646F72222C0A2020202020202020226465736372697074696F6E223A2022416E65786172207465726D6F2064652061636569746520617373696E61646F2E222C0A2020202020202020226475655F6174223A206E756C6C2C0A20202020202020202268756D616E697A65645F74696D65223A2022322D7765656B222C0A20202020202020202266696C6573223A205B0A202020202020202020207B0A20202020202020202020202022617070656E64223A20310A202020202020202020207D0A20202020202020205D2C0A2020202020202020227374657073223A205B0A202020202020202020207B0A202020202020202020202020226E616D65223A20224C6572207465726D6F222C0A202020202020202020202020226E6F746573223A20224C6572207465726D6F220A202020202020202020207D2C0A202020202020202020207B0A202020202020202020202020226E616D65223A2022456E76696172205465726D6F20646520616365697465222C0A202020202020202020202020226E6F746573223A2022456E76696172205465726D6F20646520616365697465220A202020202020202020207D0A20202020202020205D0A2020202020207D2C0A2020202020207B0A2020202020202020226E616D65223A202250726F706F7374612064652054726162616C686F20646520436F6E636C75739C6F20646520437572736F222C0A2020202020202020226465736372697074696F6E223A2022416E657861722070726F706F7374612064652054726162616C686F20646520436F6E636C75739C6F20646520437572736F2E222C0A2020202020202020226475655F6174223A206E756C6C2C0A20202020202020202268756D616E697A65645F74696D65223A2022382D7765656B222C0A20202020202020202266696C6573223A205B0A202020202020202020207B0A20202020202020202020202022617070656E64223A20320A202020202020202020207D0A20202020202020205D2C0A2020202020202020227374657073223A205B0A202020202020202020207B0A202020202020202020202020226E616D65223A20224C657220616E65786F206465206578656D706C6F222C0A202020202020202020202020226E6F746573223A20224C657220616E65786F206465206578656D706C6F220A202020202020202020207D2C0A202020202020202020207B0A202020202020202020202020226E616D65223A2022456E766961722070726F706F7374612064652054726162616C686F20646520436F6E636C75739C6F20646520437572736F222C0A202020202020202020202020226E6F746573223A2022456E766961722070726F706F7374612064652054726162616C686F20646520436F6E636C75739C6F20646520437572736F220A202020202020202020207D0A20202020202020205D0A2020202020207D2C0A2020202020207B0A2020202020202020226E616D65223A202250726F6A65746F2064652054726162616C686F20646520436F6E736C75739C6F20646520437572736F222C0A2020202020202020226465736372697074696F6E223A2022416E657861722050726F6A65746F2064652054726162616C686F20646520436F6E736C75739C6F20646520437572736F2E222C0A2020202020202020226475655F6174223A206E756C6C2C0A20202020202020202268756D616E697A65645F74696D65223A202231362D7765656B222C0A20202020202020202266696C6573223A205B0A202020202020202020207B0A20202020202020202020202022617070656E64223A20330A202020202020202020207D0A20202020202020205D2C0A2020202020202020227374657073223A205B0A202020202020202020207B0A202020202020202020202020226E616D65223A20224C657220616E65786F206465206578656D706C6F222C0A202020202020202020202020226E6F746573223A20224C657220616E65786F206465206578656D706C6F220A202020202020202020207D2C0A202020202020202020207B0A202020202020202020202020226E616D65223A202250726F6A65746F2064652054726162616C686F20646520436F6E736C75739C6F20646520437572736F222C0A202020202020202020202020226E6F746573223A202250726F6A65746F2064652054726162616C686F20646520436F6E736C75739C6F20646520437572736F220A202020202020202020207D0A20202020202020205D0A2020202020207D2C0A2020202020207B0A2020202020202020226E616D65223A2022536F6C6963697461989C6F206465204167656E64616D656E746F2064652042616E6361222C0A2020202020202020226465736372697074696F6E223A2022416E6578617220536F6C6963697461989C6F206465204167656E64616D656E746F2064652042616E63612E222C0A2020202020202020226475655F6174223A206E756C6C2C0A20202020202020202268756D616E697A65645F74696D65223A202231382D7765656B222C0A20202020202020202266696C6573223A205B0A202020202020202020207B0A20202020202020202020202022617070656E64223A20340A202020202020202020207D0A20202020202020205D2C0A2020202020202020227374657073223A205B0A20202020202020202020207B0A202020202020202020202020226E616D65223A20224C657220616E65786F206465206578656D706C6F222C0A202020202020202020202020226E6F746573223A20224C657220616E65786F206465206578656D706C6F220A202020202020202020207D2C0A202020202020202020207B0A202020202020202020202020226E616D65223A2022416E6578617220536F6C6963697461989C6F206465204167656E64616D656E746F2064652042616E6361222C0A202020202020202020202020226E6F746573223A2022416E6578617220536F6C6963697461989C6F206465204167656E64616D656E746F2064652042616E6361220A202020202020202020207D0A20202020202020205D0A2020202020207D2C0A2020202020207B0A2020202020202020226E616D65223A2022446566657361222C0A2020202020202020226465736372697074696F6E223A202244656665736120544343312E222C0A2020202020202020226475655F6174223A206E756C6C2C0A20202020202020202268756D616E697A65645F74696D65223A202231392D7765656B222C0A20202020202020202266696C6573223A205B5D2C0A2020202020202020227374657073223A205B5D0A2020202020207D0A202020205D0A20207D,
                '2024-07-26 02:22:00',
                '2024-07-26 02:22:00'
            );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
