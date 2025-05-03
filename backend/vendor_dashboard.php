<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ExpoMatrix Vendor Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <style>
    /* Global Styles */
    body {
      margin: 0;
      font-family: "Inter", sans-serif;
      background-color: #eff2f1;
      color: #6a6a6a;
      overflow-x: hidden;
    }
    a {
      text-decoration: none;
      transition: 0.3s ease;
      color: #2f2f2f;
    }
    a:hover {
      text-decoration: none;
    }

    /* Dashboard Container */
    .dashboard {
      display: flex;
      min-height: 100vh;
      overflow: hidden;
    }

    /* Sidebar */
    .sidebar {
      background-color: #3b5d50;
      width: 250px;
      flex-shrink: 0;
      padding: 20px;
      color: #fff;
      transition: width 0.3s ease;
    }
    .sidebar:hover {
      width: 300px;
    }
    .sidebar h2 {
      margin: 0;
      padding-bottom: 20px;
      font-size: 24px;
      font-weight: 700;
    }
    .menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .menu li {
      margin-bottom: 15px;
      overflow: hidden;
    }
    .menu li a {
      display: block;
      padding: 10px 15px;
      border-radius: 5px;
      font-weight: 500;
      color: #ffffff;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }
    .menu li a:hover {
      background-color: #314d43;
      transform: scale(1.05);
    }

    /* Content Area */
    .content {
      flex-grow: 1;
      background: #ffffff;
      padding: 40px;
      overflow-y: auto;
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px;
      border-bottom: 1px solid #dce5e4;
      background-color: #ffffff;
    }
    .header .logo {
      font-size: 28px;
      font-weight: 700;
      color: #3b5d50;
    }
    .header nav a {
      margin-left: 15px;
      font-weight: 500;
      color: #3b5d50;
      transition: color 0.3s ease;
    }
    .header nav a:hover {
      color: #314d43;
    }

    /* Vendor Dashboard Sections */
    .section {
      margin-top: 40px;
    }
    .section h1 {
      color: #3b5d50;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .section p {
      margin-bottom: 20px;
    }

    /* Booked Stalls Table */
    .table-container {
      overflow-x: auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    th, td {
      padding: 15px;
      text-align: center;
      border-bottom: 1px solid #dce5e4;
    }
    th {
      background-color: #eff2f1;
      font-weight: 600;
    }
    tr:hover {
      background-color: #f8f8f8;
      transition: background-color 0.3s ease;
    }
    /* Sorting Buttons */
    .sorting {
      margin-bottom: 20px;
    }
    .sorting button {
      padding: 8px 16px;
      border-radius: 20px;
      border: none;
      margin-right: 10px;
      font-weight: 600;
      cursor: pointer;
      background: #f9bf29;
      color: #2f2f2f;
      transition: background 0.3s ease, box-shadow 0.3s ease;
    }
    .sorting button:hover {
      background: #f8b810;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    /* Layout Preview Cards */
    .layouts {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .layout-card {
      background: #eff2f1;
      border: 2px solid #3b5d50;
      border-radius: 10px;
      padding: 15px;
      width: 250px;
      cursor: pointer;
      transition: transform 0.3s ease, border-color 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    .layout-card:hover {
      transform: translateY(-10px);
      border-color: #314d43;
    }
    .layout-card img {
      width: 100%;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .layout-card h3 {
      font-size: 16px;
      margin: 0;
      font-weight: 600;
      color: #3b5d50;
    }
    .layout-card .status {
      position: absolute;
      top: 10px;
      right: 10px;
      background: #3b5d50;
      color: #fff;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
    }

    /* Booking Request Form */
    .booking-form {
      background: #f8f8f8;
      padding: 20px;
      border-radius: 10px;
      border: 1px solid #dce5e4;
      max-width: 500px;
    }
    .booking-form label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #3b5d50;
    }
    .booking-form input, .booking-form select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #dce5e4;
      font-family: "Inter", sans-serif;
      font-size: 14px;
    }
    .booking-form button {
      display: block;
      width: 100%;
      padding: 12px;
      border-radius: 30px;
      font-weight: 600;
      background: #3b5d50;
      color: #ffffff;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    .booking-form button:hover {
      background: #314d43;
    }

    /* Status Cards */
    .status-cards {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 20px;
    }
    .status-card {
      flex: 1;
      min-width: 250px;
      padding: 20px;
      border-radius: 10px;
      background: #eff2f1;
      border: 2px solid #3b5d50;
      transition: transform 0.3s ease;
      cursor: pointer;
    }
    .status-card:hover {
      transform: translateY(-10px);
    }
    .status-card h3 {
      margin-top: 0;
      font-weight: 600;
      color: #3b5d50;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Sidebar Navigation -->
    <aside class="sidebar">
      <h2>ExpoMatrix Vendor</h2>
      <ul class="menu">
        <li><a href="#booked-stalls">Booked Stalls</a></li>
        <li><a href="#layout-explorer">Layout Explorer</a></li>
        <li><a href="#booking-requests">Booking Requests</a></li>
        <li><a href="#sort-filter">Sort & Filter</a></li>
        <li><a href="#account">Account</a></li>
      </ul>
    </aside>

    <!-- Main Content Area -->
    <div class="content">
      <!-- Header -->
      <div class="header">
        <div class="logo">Vendor Dashboard</div>
        <nav>
          <a href="#profile">Profile</a>
          <a href="#notifications">Notifications</a>
          <a href="#logout">Logout</a>
        </nav>
      </div>

      <!-- Section: Booked Stalls
      <section id="booked-stalls" class="section">
        <h1>Booked Stalls</h1>
        <p>View your already booked stalls along with their layouts and statuses.</p>
        <div class="table-container">
          <table>
            <thead>
              <tr>
                <th>Stall ID</th>
                <th>Location</th>
                <th>Layout</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>ST-101</td>
                <td>North Wing</td>
                <td><a href="#layoutPreview1">Preview</a></td>
                <td>Confirmed</td>
              </tr>
              <tr>
                <td>ST-102</td>
                <td>East Corner</td>
                <td><a href="#layoutPreview2">Preview</a></td>
                <td>Pending</td>
              </tr>
              <tr>
                <td>ST-103</td>
                <td>South Hall</td>
                <td><a href="#layoutPreview3">Preview</a></td>
                <td>Cancelled</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section> -->

      <!-- Section: Layout Explorer -->
      <section id="layout-explorer" class="section">
        <h1>Layout Explorer</h1>
        <p>Browse available stall layouts, view details, and make booking requests.</p>
        <div class="layouts">
          <div class="layout-card" onclick="alert('Viewing layout details for Layout A')">
            <span class="status">Available</span>
            <img src="https://via.placeholder.com/250x150?text=Layout+A" alt="Layout A">
            <h3>Layout A</h3>
          </div>
          <div class="layout-card" onclick="alert('Viewing layout details for Layout B')">
            <span class="status">Booked</span>
            <img src="https://via.placeholder.com/250x150?text=Layout+B" alt="Layout B">
            <h3>Layout B</h3>
          </div>
          <div class="layout-card" onclick="alert('Viewing layout details for Layout C')">
            <span class="status">Available</span>
            <img src="https://via.placeholder.com/250x150?text=Layout+C" alt="Layout C">
            <h3>Layout C</h3>
          </div>
        </div>
      </section>
      <div id="layoutViewerContainer" style="margin-top: 40px;"></div>
      <div id="customized-layout-div" style="margin: 40px auto;"></div>
      <script>
        const layoutId = 1; // ← You can dynamically pass this from PHP or session
      
        function loadCustomizedLayout(layoutId) {
          fetch(`fetch_layout_for_vendor.php?layout_id=${layoutId}`)
            .then(response => response.json())
            .then(data => {
              const layoutDiv = document.getElementById('customized-layout-div');
              layoutDiv.innerHTML = ''; // Clear previous
      
              if (!data || !data.dimensions || !data.elements) {
                layoutDiv.innerHTML = '<p style="color:red;">Invalid layout data.</p>';
                return;
              }
      
              const pixelsPerMeter = 40;
              const container = document.createElement('div');
              container.style.position = 'relative';
              container.style.border = '2px solid #3b5d50';
              container.style.background = '#ffffff';
              container.style.margin = '20px auto';
              container.style.width = `${data.dimensions.width * pixelsPerMeter}px`;
              container.style.height = `${data.dimensions.height * pixelsPerMeter}px`;
      
              // Stalls
              data.elements.stalls.forEach(stall => {
                const el = document.createElement('div');
                el.className = 'stall';
                el.style.position = 'absolute';
                el.style.left = `${stall.position.left * pixelsPerMeter}px`;
                el.style.top = `${stall.position.top * pixelsPerMeter}px`;
                el.style.width = `${stall.position.width * pixelsPerMeter}px`;
                el.style.height = `${stall.position.height * pixelsPerMeter}px`;
                el.style.backgroundColor = '#d0f0ff';
                el.style.border = '1px solid #333';
                el.style.fontSize = '10px';
                el.style.display = 'flex';
                el.style.alignItems = 'center';
                el.style.justifyContent = 'center';
                el.textContent = stall.name || 'Stall';
                container.appendChild(el);
              });
      
              // Gates
              data.elements.gates.forEach(gate => {
                const el = document.createElement('div');
                el.className = 'gate';
                el.style.position = 'absolute';
                el.style.left = `${gate.position.left * pixelsPerMeter}px`;
                el.style.top = `${gate.position.top * pixelsPerMeter}px`;
                el.style.width = `${gate.position.width * pixelsPerMeter}px`;
                el.style.height = `${gate.position.height * pixelsPerMeter}px`;
                el.style.backgroundColor = gate.type.includes('ENTRY') ? '#00b894' : '#d63031';
                el.style.color = '#fff';
                el.style.border = '2px solid #000';
                el.style.fontSize = '10px';
                el.style.display = 'flex';
                el.style.alignItems = 'center';
                el.style.justifyContent = 'center';
                el.textContent = gate.type;
                container.appendChild(el);
              });
      
              layoutDiv.appendChild(container);
            })
            .catch(err => {
              console.error(err);
              document.getElementById('customized-layout-div').innerHTML = '<p style="color:red;">Failed to load layout.</p>';
            });
        }
      
        // Load layout on page load
        // loadCustomizedLayout(layoutId);
      </script>
      
      <script>
        let layouts = [];
        
        // Fetch layouts from the backend
        async function fetchLayouts() {
          const res = await fetch("fetch_layouts.php");
          const data = await res.json();
          if (data.success) {
            layouts = data.layouts;
            renderLayoutCards();
          } else {
            alert("Failed to fetch layouts.");
          }
        }
        
        // Render clickable layout cards
        function renderLayoutCards() {
          const container = document.querySelector(".layouts");
          container.innerHTML = "";
        
          layouts.forEach(layout => {
            const card = document.createElement("div");
            card.className = "layout-card";
            card.innerHTML = `<span class="status">Available</span>
                              <img src="https://via.placeholder.com/250x150?text=Layout+${layout.Layout_id}" />
                              <h3>Layout ${layout.Layout_id}</h3>`;
            // card.onclick = () => showLayout(layout.layout_json);
            card.onclick = () => {
  showLayoutInCustomizedDiv(layout.layout_json);
  window.scrollTo({
    top: document.getElementById("customized-layout-div").offsetTop - 80,
    behavior: "smooth"
  });
};
            container.appendChild(card);
          });
        }
        function showLayoutInCustomizedDiv(layoutJson) {
  const data = typeof layoutJson === "string" ? JSON.parse(layoutJson) : layoutJson;
  const layoutDiv = document.getElementById('customized-layout-div');
  layoutDiv.innerHTML = ''; // Clear previous

  if (!data || !data.dimensions || !data.elements) {
    layoutDiv.innerHTML = '<p style="color:red;">Invalid layout data.</p>';
    return;
  }

  const pixelsPerMeter = 40;
  const container = document.createElement('div');
  container.style.position = 'relative';
  container.style.border = '2px solid #3b5d50';
  container.style.background = '#ffffff';
  container.style.margin = '20px auto';
  container.style.width = `${data.dimensions.width * pixelsPerMeter}px`;
  container.style.height = `${data.dimensions.height * pixelsPerMeter}px`;

  // Stalls
  data.elements.stalls.forEach(stall => {
    const el = document.createElement('div');
    el.style.position = 'absolute';
    el.style.left = `${stall.position.left * pixelsPerMeter}px`;
    el.style.top = `${stall.position.top * pixelsPerMeter}px`;
    el.style.width = `${stall.position.width * pixelsPerMeter}px`;
    el.style.height = `${stall.position.height * pixelsPerMeter}px`;
    el.style.backgroundColor = '#d0f0ff';
    el.style.border = '1px solid #333';
    el.style.fontSize = '10px';
    el.style.display = 'flex';
    el.style.alignItems = 'center';
    el.style.justifyContent = 'center';
    el.textContent = stall.name || 'Stall';
    container.appendChild(el);
  });

  // Gates
  data.elements.gates.forEach(gate => {
    const el = document.createElement('div');
    el.style.position = 'absolute';
    el.style.left = `${gate.position.left * pixelsPerMeter}px`;
    el.style.top = `${gate.position.top * pixelsPerMeter}px`;
    el.style.width = `${gate.position.width * pixelsPerMeter}px`;
    el.style.height = `${gate.position.height * pixelsPerMeter}px`;
    el.style.backgroundColor = gate.type.includes('ENTRY') ? '#00b894' : '#d63031';
    el.style.color = '#fff';
    el.style.border = '2px solid #000';
    el.style.fontSize = '10px';
    el.style.display = 'flex';
    el.style.alignItems = 'center';
    el.style.justifyContent = 'center';
    el.textContent = gate.type;
    container.appendChild(el);
  });

  layoutDiv.appendChild(container);
}

        
        // Display layout in read-only mode
        function showLayout(layoutJson) {
  const data = JSON.parse(layoutJson);
  const container = document.getElementById("layoutViewerContainer");
  container.innerHTML = ""; // clear previous

  const layoutDiv = document.createElement("div");
  layoutDiv.style.position = "relative";
  layoutDiv.style.border = "2px solid #3b5d50";
  layoutDiv.style.margin = "20px 0";
  layoutDiv.style.background = "#ffffff";
  layoutDiv.style.width = `${data.dimensions.width * 20}px`;
  layoutDiv.style.height = `${data.dimensions.height * 20}px`;

  // Entry Point
  const entry = data.entryPoint;
  const entryDiv = document.createElement("div");
  entryDiv.style.position = "absolute";
  entryDiv.style.left = `${entry.x * 20}px`;
  entryDiv.style.top = `${entry.y * 20}px`;
  entryDiv.style.width = `${entry.width * 20}px`;
  entryDiv.style.height = `${entry.height * 20}px`;
  entryDiv.style.background = "#00b894";
  entryDiv.style.border = "2px solid #098";
  entryDiv.innerText = "ENTRY";
  entryDiv.style.color = "#fff";
  entryDiv.style.fontSize = "10px";
  entryDiv.style.textAlign = "center";
  layoutDiv.appendChild(entryDiv);

  // Exit Point
  const exit = data.exitPoint;
  const exitDiv = document.createElement("div");
  exitDiv.style.position = "absolute";
  exitDiv.style.left = `${exit.x * 20}px`;
  exitDiv.style.top = `${exit.y * 20}px`;
  exitDiv.style.width = `${exit.width * 20}px`;
  exitDiv.style.height = `${exit.height * 20}px`;
  exitDiv.style.background = "#d63031";
  exitDiv.style.border = "2px solid #b71c1c";
  exitDiv.innerText = "EXIT";
  exitDiv.style.color = "#fff";
  exitDiv.style.fontSize = "10px";
  exitDiv.style.textAlign = "center";
  layoutDiv.appendChild(exitDiv);

  // Replace with real vendor ID from session or login context
  const vendorId = 1;

  // Stalls
  data.stalls.forEach((stall, index) => {
    const stallDiv = document.createElement("div");
    stallDiv.style.position = "absolute";
    stallDiv.style.left = `${stall.position.left * 20}px`;
    stallDiv.style.top = `${stall.position.top * 20}px`;
    stallDiv.style.width = `${stall.position.width * 20}px`;
    stallDiv.style.height = `${stall.position.height * 20}px`;
    stallDiv.style.border = "1px solid #333";
    stallDiv.style.backgroundColor = stall.isSmall ? "#ffeaa7" : "#a29bfe";
    stallDiv.style.fontSize = "9px";
    stallDiv.style.textAlign = "center";
    stallDiv.style.cursor = "pointer";
    stallDiv.innerHTML = `${stall.name}`;

    // Booking click
    stallDiv.addEventListener("click", () => {
      const stallId = stall.Stall_id || (index + 1); // Prefer actual Stall_id if present
      const stallName = stall.name;

      if (confirm(`Do you want to book ${stallName}?`)) {
        fetch("book_stall.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            stallId: stallId,
            vendorId: vendorId
          })
        })
        .then(res => res.json())
        .then(response => {
          if (response.success) {
            alert("Booking request submitted successfully!");
          } else {
            alert("Booking failed: " + response.message);
          }
        })
        .catch(err => alert("Error sending booking request."));
      }
    });

    layoutDiv.appendChild(stallDiv);
  });

  container.appendChild(layoutDiv);
}

        
        fetchLayouts();
        </script>

      <!-- Section: Booking Requests -->
      <!-- <section id="booking-requests" class="section">
        <h1>Booking Requests</h1>
        <p>Submit a new booking request or check the status of your previous requests.</p>
        <div class="booking-form">
          <label for="stallId">Stall ID</label>
          <input type="text" id="stallId" placeholder="Enter Stall ID" />

          <label for="layoutSelect">Select Layout</label>
          <select id="layoutSelect">
            <option value="layoutA">Layout A</option>
            <option value="layoutB">Layout B</option>
            <option value="layoutC">Layout C</option>
          </select>

          <label for="date">Preferred Date</label>
          <input type="date" id="date" />

          <button onclick="alert('Booking Request Submitted')">Submit Request</button>
        </div>

        <div class="status-cards">
          <div class="status-card" onclick="alert('Viewing details for Request #001')">
            <h3>Request #001</h3>
            <p>Status: Pending Approval</p>
          </div>
          <div class="status-card" onclick="alert('Viewing details for Request #002')">
            <h3>Request #002</h3>
            <p>Status: Confirmed</p>
          </div>
          <div class="status-card" onclick="alert('Viewing details for Request #003')">
            <h3>Request #003</h3>
            <p>Status: Rejected</p>
          </div>
        </div>
      </section> -->

      <!-- Section: Sorting & Filtering -->
      <section id="sort-filter" class="section">
        <h1>Sort & Filter Stalls</h1>
        <p>Sort your booked stalls by different criteria to quickly find the information you need.</p>
        <div class="sorting">
          <button onclick="alert('Sorting by Location')">Sort by Location</button>
          <button onclick="alert('Sorting by Status')">Sort by Status</button>
          <button onclick="alert('Sorting by Date')">Sort by Date</button>
        </div>
      </section>

      <!-- Section: Account Details (optional) -->
      <section id="account" class="section">
        <h1>Account Details</h1>
        <p>Manage your profile, contact information, and settings.</p>
        <!-- You can expand this section with more fields or tabs -->
      </section>
    </div>
  </div>
</body>
</html>
