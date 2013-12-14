<?php
include "includes/before.php";
?>
<?php
date_default_timezone_set('Asia/Shanghai');
?>
<div id="content">
<h2>简介</h2>
<p>
欢迎来到清华大学开源镜像网站，它由清华大学开源镜像站管理团队维护管理。
</p>

<p>本站可以在校内外通过 IPv4/IPv6 使用。本站域名有：</p>
<ul>
<li><a href="http://mirrors.tuna.tsinghua.edu.cn/">http://mirrors.tuna.tsinghua.edu.cn/</a> 支持 IPv4/IPv6</li>
<li><a href="http://mirrors.6.tuna.tsinghua.edu.cn/">http://mirrors.6.tuna.tsinghua.edu.cn/</a> 只解析 IPv6</li>
<li><a href="http://mirrors.4.tuna.tsinghua.edu.cn/">http://mirrors.4.tuna.tsinghua.edu.cn/</a> 只解析 IPv4</li>
</ul>

<p><strong>镜像使用所需配置参见 <a href="http://wiki.tuna.tsinghua.edu.cn/MirrorUseHowto">Wiki</a></strong>。</p>

<p>如果您有任何问题或建议，请在我们的 <a href="http://issues.tuna.tsinghua.edu.cn">issue tracker</a>
 上提交 bug，或者访问我们的<a
 href="https://groups.google.com/forum/#%21forum/thu-opensource-mirror-admin">Google
Groups</a>，或直接向 Google Groups 的邮件列表 thu-opensource-mirror-admin <span class="nospam">[SPAM]</span> AT googlegroups <span class="nospam">[SPAM]</span> DOT com 寄信。
</p>

<h3><a href="http://mirrors.tuna.tsinghua.edu.cn/webalizer/index.html">HTTP统计</a></h3>
<div id="flux-stat">
<h3><a href="http://solar.tuna.tsinghua.edu.cn:8000">流量统计</a></h3>
<p>最近24小时流量图</p>
<img src="http://solar.tuna.tsinghua.edu.cn:8000/eth0-day.png" alt="eth0-day" />
<img src="http://solar.tuna.tsinghua.edu.cn:8000/eth1-day.png" alt="eth1-day" />
<!-- IP地址可用性状态 -->
<?php
	$ips = json_decode(file_get_contents("http://dns-failover.z.tuna.tsinghua.edu.cn/ips.txt"), TRUE);
	if (is_array($ips)) {
		$ip4 = $ips['v4']; $ip6 = $ips['v6'];
		echo '<!-- IPv4 -->', PHP_EOL;
		foreach ($ip4 as $key => $value) {
			$up = $value ? "连接正常" : "无法连接";
			echo "<!-- $key $up -->\n";
		}
		echo "<!-- IPv6 -->\n";
		foreach ($ip6 as $key => $value) {
			$up = $value ? "连接正常" : "无法连接";
			echo "<!-- $key $up -->\n";
		}

	}
?>
</div> <!-- end of flux-stat div -->
</div> <!-- end of mirrors-stat div -->
</div> <!-- end of content div -->

<div id="footer">
<div class="tuna-logo">
<p>Powered by <a href="http://tuna.tsinghua.edu.cn/">
<img src="files/logo-01.png" alt="TUNA" /></a>
</p>
</div>
<div class="ack">
<p>本站的网络和硬件由清华大学网络工程研究中心提供支持。</p>
</div>
</div> <!-- end of footer div -->
<?php
include "includes/after.php";
?>
<!-- vi: se noet ts=4: -->
