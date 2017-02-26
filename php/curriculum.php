<div class="header">
  <h1>Current Curriculum
    <button class="btn btn-success pull-right" onclick="loadPage('add_curriculum')">
      <span class="fa fa-plus-circle"></span>
      Add Curriculum
    </button>
</h1>
</div>
<hr/>

<div class="curriculum-container content-container">

  <div class="curriculum-selector select-degree">
    <label>Select a degree:</label>
    <select onchange="updateSlidingSelect('.select-degree','.select-program')">
      <option value="">--Choose One--</option>
      <option value="architecture">Architectural Building Engineering Technology</option>
      <option value="auto">Automotive Service Management</option>
      <option value="business_management">Business Management</option>
      <option value="software">Software Engineering</option>
    </select>
  </div>

  <div class="curriculum-selector select-program">
    <label>Select a program:</label>
    <select onchange="updateSlidingSelect('.select-program','.select-start')">
      <option value="">--Choose One--</option>
      <option value="associate">Associate</option>
      <option value="bachelor">Bachelor</option>
      <option value="master">Master</option>
    </select>
  </div>

  <div class="curriculum-selector select-start">
    <label>Select a enrollment start:</label>
    <select onchange="updateSlidingSelect('.select-start','.result-curriculum')">
      <option value="">--Choose One--</option>
      <option value="10_16_current">October 2016 or later</option>
      <option value="10_14_09_16">October 2014 to September 2016</option>
      <option value="01_13_09_14">January 2013 to September 2014</option>
    </select>
  </div>

  <div class="result-curriculum">
    Curriculum
    <ul>
      <li>Quarter One
        <ul>
          <li>Computer and Networking Fundamentals</li>
          <li>Programming Essentails Using C++</li>
          <li>IT Visual Communications</li>
          <li>Intro to College Math</li>
        </ul>
      </li>
      <li>Quarter Two
        <span></span>
      </li>
      <li>Quarter Three
        <span></span>
      </li>
      <li>Quarter Four
        <span></span>
      </li>
    </ul>
  </div>

</div>
