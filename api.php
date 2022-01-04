<?php
$command = empty($_GET['command']) ? 0 : ($_GET['command']);
$api_KEY = empty($_GET['api_KEY']) ? 0 : ($_GET['api_KEY']);
$id = empty($_GET['id']) ? 0 : ($_GET['id']);


function getMcuuid($id)
{
    $web_Mojang = "https://api.mojang.com/users/profiles/minecraft/$id";
    $json_Mojang = file_get_contents($web_Mojang);
    
    if ($json_Mojang != "")
    {
    $arr = json_decode($json_Mojang, true);    
    $uuid = $arr["id"];
    
    return $uuid;
    } 
    else 
    {
        echo false;
    }
    
}

function getHypixelstats($api_KEY,$command,$id)
{
    /*
    *
    *
    *
    若要使用官方API 请向改函数传参$uuid
    $web_Hypixel = "https://api.hypixel.net/player?key=$api_KEY&uuid=$uuid";
    $json_Hypixel = file_get_contents($web_Hypixel);
    $arr = json_decode($json_Hypixel, true);
    $json_Player = $arr["player"];
    
    
    //Player Basic Info
    $displayName = $json_Player["displayname"];
    $timestamp_FirstLogin = $json_Player["firstLogin"]/1000;
    $timeText_FirstLogin = date("Y-m-d",$timestamp_FirstLogin);
    $timestamp_LastLogin = $json_Player["lastLogin"]/1000;
    $timeText_LastLogin = date("Y-m-d",$timestamp_LastLogin);
    
    //return array($displayName,$timeText_FirstLogin,$timeText_LastLogin);
    
    
    //Stats OF Player
    $json_StatsH = $json_Player["stats"];
    
    *
    *
    */
    
    //OFFICAL API TODO
    
    ///////////////////////////////////////////////////////////////////////////////////
    
    //Sltoh API
    $web_Sloth = "https://api.slothpixel.me/api/players/$id?key=$api_KEY";
    $json_Sloth = file_get_contents($web_Sloth);
    $arrSloth = json_decode($json_Sloth, true);
    
    //Player Basic Info and command:hyp
    
    
    if($command == "hyp")
    {
        $rank = $arrSloth["rank"];
        $karma = $arrSloth["karma"];
        $level = $arrSloth["level"];
        $achievement_points = $arrSloth["achievement_points"];
        $last_game = $arrSloth["last_game"];
        
        
        
        return array($rank,$karma,$level,$achievement_points,$last_game);
    }
    
    
    
    //GameType Stats
    $json_Stats = $arrSloth["stats"];
    $stats_bw = $json_Stats["BedWars"];
    $stats_sw = $json_Stats["SkyWars"];
    $stats_uhc = $json_Stats["UHC"];
    $stats_mw = $json_Stats["MegaWalls"];
    $stats_duel = $json_Stats["Duels"];
    
    
    
    
    //Bedwars
    if($command == "bw")
    {
        $bw_level = $stats_bw["level"];
        $bw_win = $stats_bw["wins"];
        $bw_loss = $stats_bw["losses"];
        $bw_kills = $stats_bw["kills"];
        $bw_deaths = $stats_bw["deaths"];
        $bw_fks = $stats_bw["final_kills"];
        $bw_fds = $stats_bw["final_deaths"];
        $bw_fkd = $stats_bw["final_k_d"];
        $bw_winstreak = $stats_bw["winstreak"];
        $bw_broken = $stats_bw["beds_broken"];
        
        return array($bw_level,$bw_win,$bw_loss,$bw_kills,$bw_deaths,$bw_fks,$bw_fds,$bw_fkd,$bw_winstreak,$bw_broken);
    }
    
    //Skywars
    if($command == "sw")
    {
        $sw_level = $stats_sw["level"];
        $sw_win = $stats_sw["wins"];
        $sw_loss = $stats_sw["losses"];
        $sw_kills = $stats_sw["kills"];
        $sw_deaths = $stats_sw["deaths"];
        $sw_assists = $stats_sw["assists"];
        $sw_fkd = $stats_sw["kill_death_ratio"];
        $sw_coins = $stats_sw["coins"];
        
        return array($sw_level,$sw_win,$sw_loss,$sw_kills,$sw_deaths,$sw_assists,$sw_fkd,$sw_coins);
    }
    
    //UHC
    if($command == "uhc")
    {
        $uhc_level = $stats_uhc["level"];
        $uhc_coins = $stats_uhc["coins"];
        $uhc_kills = $stats_uhc["kills"];
        $uhc_kd = $stats_uhc["kd"];
        $uhc_wins = $stats_uhc["wins"];
        $uhc_win_loss = $stats_uhc["win_loss"];
        $uhc_win_percentage = $stats_uhc["win_percentage"];
        $uhc_deaths = $stats_uhc["deaths"];
        $uhc_score = $stats_uhc["score"];
        $uhc_monthly_kills = $stats_uhc["monthly_kills"];
        $uhc_monthly_wins = $stats_uhc["monthly_wins"];
        
        return array($uhc_level,$uhc_coins,$uhc_kills,$uhc_kd,$uhc_wins,$uhc_win_loss,$uhc_win_percentage,$uhc_deaths,$uhc_score,$uhc_monthly_kills,$uhc_monthly_wins);
    }
    
    //MegaWalls
    if($command == "mw")
    {
        $mw_coins = $stats_mw["coins"];
        $mw_kills = $stats_mw["kills"];
        $mw_deaths = $stats_mw["deaths"];
        $mw_final_kills = $stats_mw["final_kills"];
        $mw_final_deaths = $stats_mw["final_deaths"];
        $mw_fkd = $stats_mw["final_kill_death_ratio"];
        $mw_final_assists = $stats_mw["final_assists"];
        $mw_wins = $stats_mw["wins"];
        $mw_losses = $stats_mw["losses"];
        
        return array($mw_coins,$mw_kills,$mw_deaths,$mw_final_kills,$mw_final_deaths,$mw_fkd,$mw_final_assists,$mw_wins,$mw_losses);
    }
    
    //Duels
    if($command == "duel")
    {
        //Duel Basic Jsons
        $duel_basic = $stats_duel["general"];
        
        
        $duel_kills = $duel_basic["kills"];
        $duel_deaths = $duel_basic["deaths"];
        $duel_kd_ratio = $duel_basic["kd_ratio"];
        $duel_coins = $duel_basic["coins"];
        $duel_wins = $duel_basic["wins"];
        $duel_losses = $duel_basic["losses"];
        $duel_bow_hit_percentage = $duel_basic["bow_hit_percentage"];
        
        
        //Duel Winstreak Jsons
        $duel_winstreak = $duel_basic["winstreaks"];
        $duel_bestWinstreak = $duel_winstreak["best"];
        $duel_currentWinstreak = $duel_winstreak["current"];
        
        $duel_bestWinstreakOverall = $duel_bestWinstreak["overall"];
        $duel_bestWinstreakSumo = $duel_bestWinstreak["sumo_duel"];
        
        $duel_currentWinstreakOverall = $duel_currentWinstreak["overall"];
        $duel_currentWinstreakSumo = $duel_currentWinstreak["sumo_duel"];
        
        return array($duel_kills,$duel_deaths,$duel_kd_ratio,$duel_coins,$duel_wins,$duel_losses,$duel_bow_hit_percentage,$duel_bestWinstreakOverall,$duel_bestWinstreakSumo,$duel_currentWinstreakOverall,$duel_currentWinstreakSumo);
    }
    
    
}


if($command != null and $api_KEY != null and $id != null)
{
    if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $id)<= 0)
    {
        if(getMcuuid($id) != false)
        {
             //command:hyp
    if($command == "hyp")
    {
        list($rank,$karma,$level,$achievement_points,$last_game) = getHypixelstats($api_KEY,$command,$id);
        $text = "该玩家的Hypixel信息:\nRank:$rank 人品值:$karma\n大厅等级:$level\n成就点:$achievement_points\n上次游玩:$last_game";
        echo $text;
        
    }
    
    //command:bw
    if($command == "bw")
    {
        list($bw_level,$bw_win,$bw_loss,$bw_kills,$bw_deaths,$bw_fks,$bw_fds,$bw_fkd,$bw_winstreak,$bw_broken) = getHypixelstats($api_KEY,$command,$id);
        echo "该玩家的起床战争信息:\n等级:$bw_level  拆床数:$bw_broken\n胜场数:$bw_win  败场数:$bw_loss\n击杀数:$bw_kills  死亡数:$bw_deaths\n最终击杀数:$bw_fks  最终死亡数:$bw_fds\nKDR:$bw_fkd  当前连胜:$bw_winstreak";
    }
    
    //command:sw
    if($command == "sw")
    {
        list($sw_level,$sw_win,$sw_loss,$sw_kills,$sw_deaths,$sw_assists,$sw_fkd,$sw_coins) = getHypixelstats($api_KEY,$command,$id);
        echo "该玩家的空岛战争信息:\n等级:$sw_level  硬币数:$sw_coins\n胜场数:$sw_win  败场数:$sw_loss\n击杀数:$sw_kills  死亡数:$sw_deaths\n助攻数:$sw_assists  KDR:$sw_fkd" ;
    }
    
    //command:uhc
    if($command == "uhc")
    {
        list($uhc_level,$uhc_coins,$uhc_kills,$uhc_kd,$uhc_wins,$uhc_win_loss,$uhc_win_percentage,$uhc_deaths,$uhc_score,$uhc_monthly_kills,$uhc_monthly_wins) = getHypixelstats($api_KEY,$command,$id);
        echo "该玩家的UHC信息:\n等级:$uhc_level  硬币数:$uhc_coins Scores:$uhc_score\n胜场数:$uhc_wins  败场数:$uhc_win_loss  胜率:$uhc_win_percentage\n击杀数:$uhc_kills  死亡数:$uhc_deaths  KDR:$uhc_kd\n本月击杀数:$uhc_monthly_kills  本月胜场数:$uhc_monthly_wins";
    } 
    
    //command:mw
    if($command == "mw")
    {
        list($mw_coins,$mw_kills,$mw_deaths,$mw_final_kills,$mw_final_deaths,$mw_fkd,$mw_final_assists,$mw_wins,$mw_losses) = getHypixelstats($api_KEY,$command,$id);
        echo "该玩家的超级战墙信息:\n击杀数:$mw_kills  死亡数:$mw_deaths\n最终击杀数:$mw_final_kills  最终死亡数:$mw_final_deaths\n最终助攻数:$mw_final_assists  硬币数:$mw_coins\n胜场数:$mw_wins  败场数:$mw_losses";
    }
    
    //command:duel
    if($command == "duel")
    {
        list($duel_kills,$duel_deaths,$duel_kd_ratio,$duel_coins,$duel_wins,$duel_losses,$duel_bow_hit_percentage,$duel_bestWinstreakOverall,$duel_bestWinstreakSumo,$duel_currentWinstreakOverall,$duel_currentWinstreakSumo) = getHypixelstats($api_KEY,$command,$id);
        echo "该玩家的Duel信息:\n总击杀:$duel_kills  总死亡:$duel_deaths  KDR:$duel_kd_ratio\n总胜场:$duel_wins  总败场:$duel_losses\n硬币:$duel_coins  命中率:$duel_bow_hit_percentage\n         连胜信息:\n最佳总连胜:$duel_bestWinstreakOverall\n最佳Sumo连胜:$duel_bestWinstreakSumo\n当前总连胜:$duel_currentWinstreakOverall\n当前Sumo连胜:$duel_currentWinstreakSumo";
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
        }
        
        else if(getMcuuid($id) == false)
        
        {
            echo "玩家不存在";
        }
    }
 
} 

else if($api_KEY == "0")

{
    echo "请依据设置中教程填写APIKEY";

} 

else if($id == "0")

{
    echo "请填入玩家ID";
}


?>