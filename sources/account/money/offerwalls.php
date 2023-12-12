<div class="container-fluid py-4">
    <div class="card">
        <div class="card-header pb-0">
          <h6>Earn money by completing Offers and Tasks</h6>
        </div>
        <div class="card-body p-3">
            <style>
            /* Style the tab */
            .tab {
              overflow: hidden;
              border: 1px solid #9A6200;
              background-color: #9A6200;
              border-radius:9px;
            }
            
            /* Style the buttons inside the tab */
            .tab button {
              background-color: inherit;
              border: none;
              outline: none;
              cursor: pointer;
              padding: 8px 8px;
              transition: 0.3s;
              font-size: 15px;
              color:#fff;
            }
            
            /* Change background color of buttons on hover */
            .tab button:hover {
              background-color: #CD880F;color:#fff;
            }
            
            /* Create an active/current tablink class */
            .tab button.active {
              background-color: #CD880F;color:#fff;
            }
            
            /* Style the tab content */
            .tabcontent {
              display: none;
              padding: 6px 12px;
              border: 3px solid #ccc;
              border-top: none;
              border-radius:9px;
            }
            </style>
            <div class="tab">
              <center>
                  <button class="tablinks" onclick="openCity(event, 'Bitlab')">Bitlab</button>
                  <button class="tablinks" onclick="openCity(event, 'Wannads')">Wannads</button>
                  <button class="tablinks" onclick="openCity(event, 'Monlix')">Monlix</button>
                  <button class="tablinks" onclick="openCity(event, 'CPX Research')">CPX Research</button>
              </center>
            </div>
            <br>
            <div id="Bitlab" class="tabcontent">
              <?php
              $api_key_bitlabs = $settings['bitlabs_api'];
              ?>
              <iframe src="https://web.bitlabs.ai/?uid=<?=$_SESSION['uid']; ?>&token=<?=$api_key_bitlabs?>" style="width:100%; height:800px; border:0; padding:0; margin:0;" scrolling="yes" frameborder="0"></iframe>
            </div>
            
            <div id="Wannads" class="tabcontent">
              <?php
              $api_key_wannads = $settings['wannads_api'];
              ?>
              <iframe style="width:100%; height:800px; border:0; padding:0; margin:0;" scrolling="yes" frameborder="0" src="https://wall.wannads.com/wall?apiKey=<?=$api_key_wannads?>&userId=<?=$_SESSION['uid']; ?>"></iframe>
            </div>
            
            <div id="Monlix" class="tabcontent">
              <?php
              $api_key_monlix = $settings['monlix_api'];
              ?>
              <iframe src="https://offers.monlix.com/?appid=<?=$api_key_monlix?>&userid=<?=$_SESSION['uid']; ?>"  scrolling="yes" frameborder="0"  style="width:100%; height:800px; border:0; padding:0; margin:0;" /></iframe>
            </div>
            
            <div id="CPX Research" class="tabcontent">
              <?php
              $api_key_cpx = $settings['cpxresearch_api'];
              ?>
              <iframe src="https://offers.cpx-research.com/index.php?app_id=<?=$api_key_cpx?>&ext_user_id=<?=$_SESSION['uid']; ?>" style="width:100%; height:800px; border:0; padding:0; margin:0;" scrolling="yes" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>


<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>