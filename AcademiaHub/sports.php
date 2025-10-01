<?php include('header.php'); ?>
<div  style="padding: 40px 20px;">
    <h1 class="text-center" style="color: #008000; margin-bottom: 30px;">Sports Facilities</h1>
    
    <div class="content" style="background: rgba(255, 255, 255, 0.95); padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <div class="sports-section">
            <h2 style="color: #006400; margin-bottom: 20px;">Available Sports Facilities</h2>
            
            <div class="facilities-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 40px;">
                <div class="facility-card" style="padding: 20px; background: rgba(0,128,0,0.05); border-radius: 10px;">
                    <h3 style="color: #008000; margin-bottom: 15px;">
                        <i class="fas fa-futbol" style="margin-right: 10px;"></i>
                        Indoor Games
                    </h3>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li style="margin-bottom: 8px;">Table Tennis</li>
                        <li style="margin-bottom: 8px;">Carrom</li>
                        <li style="margin-bottom: 8px;">Chess</li>
                        <li style="margin-bottom: 8px;">Badminton</li>
                    </ul>
                </div>

                <div class="facility-card" style="padding: 20px; background: rgba(0,128,0,0.05); border-radius: 10px;">
                    <h3 style="color: #008000; margin-bottom: 15px;">
                        <i class="fas fa-running" style="margin-right: 10px;"></i>
                        Outdoor Sports
                    </h3>
                    <ul style="list-style-type: none; padding-left: 0;">
                        <li style="margin-bottom: 8px;">Cricket</li>
                        <li style="margin-bottom: 8px;">Football</li>
                        <li style="margin-bottom: 8px;">Basketball</li>
                        <li style="margin-bottom: 8px;">Volleyball</li>
                    </ul>
                </div>
            </div>

            <h2 style="color: #006400; margin-bottom: 20px;">Sports Events</h2>
            <div class="events-section" style="padding: 20px; background: rgba(0,128,0,0.05); border-radius: 10px; margin-bottom: 30px;">
                <h3 style="color: #008000; margin-bottom: 15px;">Upcoming Tournaments</h3>
                <ul style="list-style-type: none; padding-left: 0;">
                    <li style="margin-bottom: 15px; padding-left: 25px; position: relative;">
                        <i class="fas fa-trophy" style="color: #008000; position: absolute; left: 0;"></i>
                        Inter-Department Cricket Tournament (September 2025)
                    </li>
                    <li style="margin-bottom: 15px; padding-left: 25px; position: relative;">
                        <i class="fas fa-trophy" style="color: #008000; position: absolute; left: 0;"></i>
                        Annual Sports Meet (October 2025)
                    </li>
                    <li style="margin-bottom: 15px; padding-left: 25px; position: relative;">
                        <i class="fas fa-trophy" style="color: #008000; position: absolute; left: 0;"></i>
                        Table Tennis Championship (November 2025)
                    </li>
                </ul>
            </div>

            <div class="sports-teams" style="padding: 20px; background: rgba(0,128,0,0.05); border-radius: 10px;">
                <h3 style="color: #008000; margin-bottom: 15px;">University Teams</h3>
                <p style="margin-bottom: 15px;">
                    Join our university teams and represent GUB in inter-university tournaments. Regular practice 
                    sessions are conducted under the guidance of professional coaches.
                </p>
                <a href="#" class="btn" style="display: inline-block; padding: 10px 20px; background: #008000; color: white; text-decoration: none; border-radius: 5px;">
                    Join Sports Team
                </a>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
