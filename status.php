<?php
  include "includes/before.php";
  include "includes/distros.php";
  include "includes/disk.php";
?>

<div class="mirrors-stat pure-u-1">
  <h2>状态统计</h2>
  <div id="status-table">
    <h3>各镜像状态表<a href="#status-table-footnote" title="到表尾脚注">↓</a></h3>
    <table class="tablesorter" id="status-main-table">
      <thead>
        <tr>
          <th><img height="16" width="16" src="files/official-header.png"
            alt="Is an official mirror?"/></th>
          <th>名称</th>
          <th>维护者</th>
          <th>状态</th>
          <th>大小</th>
          <th>文件总数</th>
          <th>同步完成时间</th>
          <th>请求次数</th>
          <th>请求数据量</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($specs as $spec): ?>
        <?php $info = $status[$spec[0]] ?>
        <tr>
          <td class="official"><?php
              switch ($spec[3][0]) {
                case 'A':
                  echo '<a href="http://', $spec[3]['url'] ,'" target="_blank"><img height="16" width="16" src="files/official.png" alt="official"/></a>';
                  break;
                case 'B':
                  echo '<img height="16" width="16" src="files/official.png" alt="official"/>';
                  break;
                case 'N':
                  echo '<img height="16" width="16" src="files/non-official.png" alt="non-official"/>';
                  break;
                case 'U':
                  echo '<img height="16" width="16" src="files/unknown.png" alt="unknown"/>';
                  break;
                default:
                  break;
              }
            ?></td>

          <td>
            <a name="<?php echo $spec[0] ?>" href="<?php echo $spec[0] ?>/" title="<?php echo $spec[1] ?>">
              <?php echo $spec[0] ?>
            </a>
          </td>
          <td><?php echo maintainer($spec[2]) ?></td>
          <?php if ($info['current'] == 'success'): ?>
          <td class="sync-state sync-ed">同步完成</td>
          <?php elseif ($info['current'] == 'syncing'): ?>
          <td class="sync-state sync-ing">正在同步</td>
          <?php elseif ($info['current'] == 'failed'): ?>
          <td class="sync-state sync-fail">同步失败</td>
          <?php elseif ($info['current'] == 'checking'): ?>
          <td class="sync-state sync-fail">人工维护</td>
          <?php else: ?>
          <td class="sync-state sync-unknown">未知</td>
          <?php endif ?>

          <td class="size"><?php echo format_size($info['size']) ?></td>
          <td class="files_count"><?php echo $info['files_count'] ?></td>
          <td><?php echo $info['stamp'] ? date('Y-m-d H:i', $info['stamp']) : '' ?></td>
          <?php $stat = stat_by_distro_get($spec[0], 'week'); ?>
          <td class="req_files_count"><?php echo $stat[0]; ?></td>
          <td class="req_size"><?php echo convert_byte_to_text($stat[1]);?></td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table> <!-- id="status-main-table" -->
    <div id="status-table-footnote">
      <ul>
        <li>第一列显示是否为发行版/项目的官方软件源。</li>
        <li>对于正在同步和同步失败的镜像，大小、文件总数、同步完成时间等信息取自最近一次成功同步时的日志。</li>
        <li>请求次数/数据量取自最近七日的 HTTP 请求。</li>
      </ul>
    </div> <!-- end of status-table-footnote div -->
  </div> <!-- end of status-table div -->

  <p>磁盘使用：<br/>
  <?php
    echo sprintf("总容量：%s&nbsp;&nbsp;已使用：%s&nbsp;&nbsp;剩余容量：%s&nbsp;&nbsp;使用比例：%s%%",
    $diskusage['total'], $diskusage['used'], $diskusage['free'], $diskusage['percent']);
  ?><br/>
  <div id="diskusage" style="height:15px"></div>
  </p>
</div> <!-- end of mirrors-stat div -->
<?php
  include "includes/after.php";
?>
