<footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © {{ Auth::user()->church_name }} {{ $year }}</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end">  <a href="www.joelandit.com" target="_blank"></a> {{ Auth::user()->email }}</span>
            </div>
          </footer>